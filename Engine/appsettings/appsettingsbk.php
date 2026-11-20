<?php
// engine/settings/SysSettingBk.php
declare(strict_types=1);

// session_start();

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

if (empty($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Session expired.']);
    exit;
}

$raw = file_get_contents('php://input');
$body = json_decode($raw, true);
if (!is_array($body)) {
    $body = $_POST;
}

$action = $body['action'] ?? '';


try {
    switch ($action) {
        
         // ==========================================
        // ROLE MANAGEMENT ACTIONS
        // ==========================================
        case 'getroles':
            $stmt = $conn->query("SELECT * FROM roledefinition ORDER BY id DESC");
            echo json_encode(['ok' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
            break;

        case 'saverole':
            $id = (int)($body['Id'] ?? 0);
            $errors = validateDynamicForm('role_definition', $body);
            if (!empty($errors)) { echo json_encode(['ok' => false, 'errors' => $errors]); exit; }
            
            $schema = include dirname(__DIR__) . '/cache/dynamicforms.cache.php';
            $fields = $schema['role_definition']['Details']['fields'];
            $data = [];
            foreach ($fields as $field) { $data[$field['name']] = trim((string)($body[$field['name']] ?? '')); }
            
            if ($id > 0) { updateRecordNoLog($conn, 'roledefinition', $data, ['id' => $id]); }
            else { insertRecordNoLog($conn, 'roledefinition', $data); }
            echo json_encode(['ok' => true, 'message' => 'Role saved successfully.']);
            break;

        case 'deleterole':
            deleteRecordNoLog($conn, 'roledefinition', ['id' => (int)$body['Id']]);
            echo json_encode(['ok' => true, 'message' => 'Role deleted successfully.']);
            break;

        case 'getmappedroutes':
            $rolecode = $body['rolecode'] ?? '';
            $stmt = $conn->prepare("SELECT mr.id, mr.route, rd.MenuName, rd.Module FROM menutorole mr LEFT JOIN routedefinition rd ON mr.route = rd.Route WHERE mr.rolecode = ?");
            $stmt->execute([$rolecode]);
            echo json_encode(['ok' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
            break;

        case 'getavailable_routes':
            $stmt = $conn->query("SELECT Route, MenuName, Module FROM routedefinition WHERE Status = 1 AND SideMenu = 1 ORDER BY MenuName");
            echo json_encode(['ok' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
            break;

        case 'addroutetorole':
            $data = ['rolecode' => $body['rolecode'], 'route' => $body['route']];
            insertRecordNoLog($conn, 'menutorole', $data);
            echo json_encode(['ok' => true, 'message' => 'Route added to role.']);
            break;

        case 'removeroutefromrole':
            deleteRecordNoLog($conn, 'menutorole', ['id' => (int)$body['id']]);
            echo json_encode(['ok' => true, 'message' => 'Route removed.']);
            break;

        case 'getmappedstaff':
            $rolecode = $body['rolecode'] ?? '';
            $stmt = $conn->prepare("SELECT rum.id, u.staffid, u.full_name FROM roletousermapping rum JOIN users u ON rum.staffid = u.staffid WHERE rum.rolecode = ?");
            $stmt->execute([$rolecode]);
            echo json_encode(['ok' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
            break;

        case 'getavailable_staff':
            // Get users who are NOT already mapped to this role
            $rolecode = $body['rolecode'] ?? '';
            $stmt = $conn->prepare("SELECT staffid, full_name FROM users WHERE is_active = 1 AND staffid NOT IN (SELECT staffid FROM roletousermapping WHERE rolecode = ?)");
            $stmt->execute([$rolecode]);
            echo json_encode(['ok' => true, 'data' => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
            break;

        case 'addstafftorole':
            $data = ['rolecode' => $body['rolecode'], 'staffid' => $body['staffid']];
            insertRecordNoLog($conn, 'roletousermapping', $data);
            echo json_encode(['ok' => true, 'message' => 'Staff mapped to role.']);
            break;

        case 'removestafffromrole':
            deleteRecordNoLog($conn, 'roletousermapping', ['id' => (int)$body['id']]);
            echo json_encode(['ok' => true, 'message' => 'Staff removed from role.']);
            break;

        default:
            throw new Exception('Invalid action specified.');
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}