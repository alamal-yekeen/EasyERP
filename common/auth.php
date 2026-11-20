<?php
// common/auth.php
declare(strict_types=1);

/**
 * Start a hardened session. Call ONCE, before any output.
 * Call this from every script that touches $_SESSION.
 */
function secureSessionStart(array $cfg): void {
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    session_name($cfg['session_name']);

    session_set_cookie_params([
        'lifetime' => 0,                       // browser-session cookie
        'path'     => '/',
        'domain'   => '',
        'secure'   => $cfg['cookie_secure'],
        'httponly' => true,
        'samesite' => 'Lax',                   // 'Strict' breaks some flows
    ]);

    ini_set('session.use_strict_mode',  '1');  // reject unknown IDs
    ini_set('session.use_only_cookies', '1');
    ini_set('session.cookie_httponly',  '1');
    ini_set('session.gc_maxlifetime',   (string)$cfg['session_lifetime']);

    session_start();

    // Rotate ID periodically (and always on login)
    if (!isset($_SESSION['created_at'])) {
        $_SESSION['created_at'] = time();
    } elseif (time() - $_SESSION['created_at'] > 1800) {
        session_regenerate_id(true);
        $_SESSION['created_at'] = time();
    }

    // Idle timeout
    if (isset($_SESSION['last_activity'])
        && time() - $_SESSION['last_activity'] > $cfg['session_idle_limit']) {
        destroySession();
        session_start();
    }
    $_SESSION['last_activity'] = time();
}

function destroySession(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

/** CSRF token for the current session (generate if missing). */
function csrfToken(): string {
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

/** Constant-time CSRF check. */
function csrfVerify(?string $token): bool {
    return !empty($_SESSION['csrf'])
        && is_string($token)
        && hash_equals($_SESSION['csrf'], $token);
}

/**
 * Rate-limiter using the DB (works across multiple PHP workers).
 * Returns true if the caller is ALLOWED to proceed.
 */
function rateLimitAllow(PDO $conn, string $email, string $ipBin, array $cfg): bool {
    $since = date('Y-m-d H:i:s', time() - $cfg['rate_window_seconds']);

    $stmt = $conn->prepare(
        "SELECT
            SUM(email = ?) AS by_email,
            SUM(ip    = ?) AS by_ip
         FROM login_attempts
         WHERE created_at >= ?"
    );
    $stmt->execute([$email, $ipBin, $since]);
    $row = $stmt->fetch() ?: ['by_email' => 0, 'by_ip' => 0];

    return ((int)$row['by_email'] < $cfg['rate_max_per_email'])
        && ((int)$row['by_ip']    < $cfg['rate_max_per_ip']);
}

/** Record an attempt (success or failure) for rate-limiting. */
function recordAttempt(PDO $conn, string $email, string $ipBin,
                       string $ua, bool $success): void {
    $stmt = $conn->prepare(
        "INSERT INTO login_attempts (email, ip, user_agent, success)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->execute([$email, $ipBin, mb_substr($ua, 0, 255), (int)$success]);
}

/**
 * Verify credentials. Returns the user row on success, null on failure.
 * Updates failed_attempts / locked_until / last_login_* atomically.
 */
function verifyCredentials(PDO $conn, string $email, string $password,
                           string $ipBin, array $cfg): ?array {
    $stmt = $conn->prepare(
        "SELECT id, email, password_hash, full_name, is_active,
                failed_attempts, locked_until
         FROM users WHERE email = ? LIMIT 1"
    );
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Always run password_verify even if user missing → constant-ish time,
    // prevents "user enumeration by timing".
    $hash = $user['password_hash'] ?? '$2y$10$invalidinvalidinvalidinvalidinvalidinva';

    if ($user && $user['locked_until'] !== null
        && strtotime($user['locked_until']) > time()) {
        // Locked out — still verify to burn time, then fail.
        password_verify($password, $hash);
        return null;
    }

    if (!$user || !password_verify($password, $hash)) {
        if ($user) {
            $newAttempts = (int)$user['failed_attempts'] + 1;
            $lock = $newAttempts >= $cfg['max_failed_attempts']
                ? date('Y-m-d H:i:s', time() + $cfg['lockout_seconds'])
                : null;
            $upd = $conn->prepare(
                "UPDATE users SET failed_attempts = ?, locked_until = ?
                 WHERE id = ?"
            );
            $upd->execute([$newAttempts, $lock, $user['id']]);
        }
        return null;
    }

    if ((int)$user['is_active'] !== 1) {
        return null;
    }

    // Success — reset counters, stamp last login.
    $upd = $conn->prepare(
        "UPDATE users
         SET failed_attempts = 0, locked_until = NULL,
             last_login_at = NOW(), last_login_ip = ?
         WHERE id = ?"
    );
    $upd->execute([$ipBin, $user['id']]);

    // Transparent rehash if algorithm/cost changed
    if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
        $newHash = password_hash($password, PASSWORD_DEFAULT);
        $conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?")
            ->execute([$newHash, $user['id']]);
    }

    return $user;
}

/** Issue a new session (call AFTER successful login). */
function issueSession(PDO $conn, int $userId, string $ipBin,  string $ua, array $cfg): string {
    session_regenerate_id(true);                  // ← prevents session fixation
    $_SESSION['user_id']    = $userId;
    $_SESSION['logged_in']  = true;
    $_SESSION['created_at'] = time();

    $sid     = bin2hex(random_bytes(32));
    $expires = date('Y-m-d H:i:s', time() + $cfg['session_lifetime']);

    $conn->prepare(
        "INSERT INTO user_sessions
            (id, user_id, ip, user_agent, expires_at)
         VALUES (?, ?, ?, ?, ?)"
    )->execute([$sid, $userId, $ipBin, mb_substr($ua, 0, 255), $expires]);

    $_SESSION['db_session_id'] = $sid;
    return $sid;
}

/** Require a logged-in user on protected pages. */
function requireLogin(PDO $conn): array {
    if (empty($_SESSION['user_id']) || empty($_SESSION['db_session_id'])) {
        header('Location: /login');
        exit;
    }
    $stmt = $conn->prepare(
        "SELECT u.* FROM users u
         JOIN user_sessions s ON s.user_id = u.id
         WHERE s.id = ? AND s.revoked_at IS NULL
           AND s.expires_at > NOW() AND u.is_active = 1
         LIMIT 1"
    );
    $stmt->execute([$_SESSION['db_session_id']]);
    $user = $stmt->fetch();
    if (!$user) {
        destroySession();
        header('Location: //login');
        exit;
    }
    $conn->prepare("UPDATE user_sessions SET last_seen_at = NOW() WHERE id = ?")
        ->execute([$_SESSION['db_session_id']]);
    return $user;
}

/** Convert textual IP to VARBINARY(16) safely. */
function ipToBinary(string $ip): string {
    $bin = @inet_pton($ip);
    return $bin === false ? "\0\0\0\0" : $bin;   // 4-byte IPv4 or 16-byte IPv6
}