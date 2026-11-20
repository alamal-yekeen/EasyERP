<?php
// Engine/general/loginbk.php
declare(strict_types=1);

secureSessionStart($config);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');

function jsonOut(int $code, array $body): void {
    http_response_code($code);
    echo json_encode($body, JSON_UNESCAPED_UNICODE);
    exit;
}

// Read JSON body (your JS sends application/json) OR form-encoded
$raw  = file_get_contents('php://input');
$body = json_decode($raw, true);
if (!is_array($body)) {
    $body = $_POST;
}

if(($body['login'] === 1)) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        jsonOut(405, ['ok' => false, 'error' => 'Method not allowed']);
    }

    $email    = trim((string)($body['email']    ?? ''));
    $password = (string)($body['password'] ?? '');
    $csrf     = (string)($body['csrf']     ?? '');

    // CSRF
    if (!csrfVerify($csrf)) {
        jsonOut(403, ['ok' => false, 'error' => 'Session expired. Refresh and try again.']);
    }

    // Basic validation
    if ($email === '' || $password === '') {
        jsonOut(422, ['ok' => false, 'error' => 'Username and password required.']);
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Generic message — do not hint whether email exists.
        jsonOut(401, ['ok' => false, 'error' => 'Invalid credentials.']);
    }

    if (strlen($password) < 1 || strlen($password) > 1024) {
        jsonOut(401, ['ok' => false, 'error' => 'Invalid credentials.']);
    }

    $ipBin = ipToBinary($_SERVER['REMOTE_ADDR'] ?? '0.0.0.0');
    $ua    = $_SERVER['HTTP_USER_AGENT'] ?? '';

    // Rate-limit
    if (!rateLimitAllow($conn, $email, $ipBin, $config)) {
        recordAttempt($conn, $email, $ipBin, $ua, false);
        jsonOut(429, ['ok' => false, 'error' => 'Too many attempts. Try again later.']);
    }

    // Verify (handles lockout, failed-attempt counting, rehash)
    try {
        $user = verifyCredentials($conn, $email, $password, $ipBin, $config);
    } catch (Throwable $e) {
        error_log('login error: ' . $e->getMessage());
        jsonOut(500, ['ok' => false, 'error' => 'Server error.']);
    }

    if (!$user) {
        recordAttempt($conn, $email, $ipBin, $ua, false);
        jsonOut(401, ['ok' => false, 'error' => 'Invalid credentials.']);
    }

    // Success
    recordAttempt($conn, $email, $ipBin, $ua, true);
    issueSession($conn, (int)$user['id'], $ipBin, $ua, $config);

    jsonOut(200, [
        'ok'        => true,
        'redirect'  => 'home',
        'user'      => [
            'id'    => (int)$user['id'],
            'name'  => $user['full_name'],
            'email' => $user['email'],
        ],
    ]);
    exit();

}
// Only POST


if (!empty($_SESSION['db_session_id'])) {
    $conn->prepare("UPDATE user_sessions SET revoked_at = NOW() WHERE id = ?")
        ->execute([$_SESSION['db_session_id']]);
}

destroySession();
header('Location: login');
exit;
