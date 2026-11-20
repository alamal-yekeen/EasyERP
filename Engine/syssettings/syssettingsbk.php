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
        // MODULE DEFINITION ACTIONS
        // ==========================================
        case 'savemodule':
            $id = (int)($body['Id'] ?? 0);

            // 1. Validate using the server-side JSON schema
            $errors = validateDynamicForm('moduledev', $body);

            if (!empty($errors)) {
                echo json_encode(['ok' => false, 'errors' => $errors]);
                exit;
            }

            // 2. Prepare data for insertion
            // We grab the fields based on the schema's 'name' keys.
            $schema = include 'cache/dynamicforms.cache.php';
            $fields = $schema['moduledev']['Details']['fields'];
            
            $data = [];
            foreach ($fields as $field) {
                $name = $field['name'];
                $data[$name] = trim((string)($body[$name] ?? ''));
            }

            // 3. Insert or Update
            if ($id > 0) {
                updateRecordNoLog($conn, 'ModuleDefinition', $data, ['Id' => $id]);
                echo json_encode(['ok' => true, 'message' => 'Module updated successfully.']);
            } else {
                insertRecordNoLog($conn, 'ModuleDefinition', $data);
                echo json_encode(['ok' => true, 'message' => 'Module created successfully.']);
            }
            break;

        case 'deletemodule':
            $id = (int)($body['Id'] ?? 0);
            if ($id <= 0) throw new Exception('Invalid Module ID.');
            deleteRecordNoLog($conn, 'ModuleDefinition', ['Id' => $id]);
            echo json_encode(['ok' => true, 'message' => 'Module deleted successfully.']);
            break;

        case 'getmodules':
            $stmt = $conn->query("SELECT * FROM ModuleDefinition ORDER BY Id DESC");
            $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['ok' => true, 'data' => $modules]);
            break;

 
        // ==========================================
        // DYNAMIC FORM ACTIONS
        // ==========================================
        case 'getforms':
            $stmt = $conn->query("SELECT id, name, title, description FROM dynamic_forms ORDER BY id DESC");
            $forms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['ok' => true, 'data' => $forms]);
            break;

        case 'getformbyid':
            $id = (int)($body['id'] ?? 0);
            $stmt = $conn->prepare("SELECT * FROM dynamic_forms WHERE id = ?");
            $stmt->execute([$id]);
            $form = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($form) {
                // Keep the JSON as a string for the editor
                echo json_encode(['ok' => true, 'data' => $form]);
            } else {
                echo json_encode(['ok' => false, 'error' => 'Form not found.']);
            }
            break;

        case 'saveform':
            $id          = (int)($body['Id'] ?? 0);
            $name        = trim((string)($body['name'] ?? ''));
            $title       = trim((string)($body['title'] ?? ''));
            $description = trim((string)($body['description'] ?? ''));
            $details     = trim((string)($body['details'] ?? ''));

            $errors = [];
            if ($name === '') $errors['name'] = 'Form Name is required.';
            if ($title === '') $errors['title'] = 'Form Title is required.';
            if ($details === '') $errors['details'] = 'Form Details are required.';

            // Ensure valid JSON
            if ($details !== '') {
                json_decode($details);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $errors['details'] = 'Invalid JSON format: ' . json_last_error_msg();
                }
            }

            if (!empty($errors)) {
                echo json_encode(['ok' => false, 'errors' => $errors]);
                exit;
            }

            // Check for duplicate name (only if creating new or changing name)
            $stmt = $conn->prepare("SELECT id FROM dynamic_forms WHERE name = ? AND id != ?");
            $stmt->execute([$name, $id]);
            if ($stmt->fetch()) {
                echo json_encode(['ok' => false, 'errors' => ['name' => 'This Form Name is already taken.']]);
                exit;
            }

            $data = [
                'name'        => $name,
                'title'       => $title,
                'description' => $description,
                'details'     => $details // PDO will handle JSON column insert
            ];

            if ($id > 0) {
                updateRecordNoLog($conn, 'dynamic_forms', $data, ['id' => $id]);
                $msg = 'Form updated successfully.';
            } else {
                insertRecordNoLog($conn, 'dynamic_forms', $data);
                $msg = 'Form created successfully.';
            }

            // CRITICAL: Rebuild the cache so the new form is instantly available
            catchdynamicforms($conn, 3600, true);

            echo json_encode(['ok' => true, 'message' => $msg]);
            break;

        case 'deleteform':
            $id = (int)($body['id'] ?? 0);
            if ($id <= 0) throw new Exception('Invalid Form ID.');
            
            deleteRecordNoLog($conn, 'dynamic_forms', ['id' => $id]);
            
            // Rebuild the cache
            catchdynamicforms($conn, 3600, true);
            
            echo json_encode(['ok' => true, 'message' => 'Form deleted successfully.']);
            break;

         // ==========================================
        // ROUTE DEFINITION ACTIONS
        // ==========================================
        case 'getroutes':
            $stmt = $conn->query("SELECT * FROM routedefinition ORDER BY Id DESC");
            $routes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode(['ok' => true, 'data' => $routes]);
            break;

        case 'saveroute':
            $id = (int)($body['Id'] ?? 0);

            

            // 1. Server-side validation against the schema
            $errors = validateDynamicForm('route_definition', $body);
            
            if (!empty($errors)) {
                echo json_encode(['ok' => false, 'errors' => $errors]);
                exit;
            }
            
            // 2. Prepare data dynamically based on schema
            $schema = include 'cache/dynamicforms.cache.php';
            $fields = $schema['route_definition']['Details']['fields'];
            
            $data = [];
            foreach ($fields as $field) {
                $name = $field['name'];
                $data[$name] = trim((string)($body[$name] ?? ''));
            }

            // 3. Insert or Update
            if ($id > 0) {
                updateRecordNoLog($conn, 'routedefinition', $data, ['Id' => $id]);
                $msg = 'Route updated successfully.';
            } else {
                insertRecordNoLog($conn, 'routedefinition', $data);
                $msg = 'Route created successfully.';
            }

            // 4. CRITICAL: Rebuild the routes cache
            catchroute($conn);

            echo json_encode(['ok' => true, 'message' => $msg]);
            break;

        case 'deleteroute':
            $id = (int)($body['Id'] ?? 0);
            if ($id <= 0) throw new Exception('Invalid Route ID.');
            
            deleteRecordNoLog($conn, 'routedefinition', ['Id' => $id]);
            
            // CRITICAL: Rebuild the routes cache
            catchroute($conn);
            
            echo json_encode(['ok' => true, 'message' => 'Route deleted successfully.']);
            break;

        default:
            throw new Exception('Invalid action specified.');
    }

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}