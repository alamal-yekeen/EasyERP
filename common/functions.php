<?php 

function catchroute($conn){
    // Cache folder in parent directory (outside 'common')
    $cacheDir = dirname(__DIR__) . '/cache';
    $cacheFile = $cacheDir . '/routes.cache.php';
    
    // Create cache directory if it doesn't exist
    if (!is_dir($cacheDir)) {
        if (!mkdir($cacheDir, 0755, true)) {
            error_log("Failed to create cache directory: " . $cacheDir);
            return false;
        }
    }
    
    // Check if directory is writable
    if (!is_writable($cacheDir)) {
        error_log("Cache directory is not writable: " . $cacheDir);
        return false;
    }
    
    // Fetch ALL active routes from database
    try {
        $sql = "SELECT route, type, page, module FROM routedefinition WHERE status = '1' ORDER BY module";
        $stmt = $conn->query($sql);
        
        $routes = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $routes[strtolower($row['route'])] = [
                'Type' => $row['type'],
                'Page' => $row['page'],
                'Module' => $row['module']
            ];
        }
        
    } catch (PDOException $e) {
        error_log("Failed to fetch routes: " . $e->getMessage());
        return false;
    }
    
    // --- Write cache atomically ---
    $cacheContent = '<?php' . PHP_EOL 
                  . '// Auto-generated cache file — do not edit manually.' . PHP_EOL 
                  . '// Generated: ' . date('Y-m-d H:i:s') . PHP_EOL 
                  . 'return ' . var_export($routes, true) . ';';
    
    $tmpFile = $cacheFile . '.tmp.' . getmypid();

    if (file_put_contents($tmpFile, $cacheContent, LOCK_EX) === false) {
        error_log("Failed to write temp cache file: " . $tmpFile);
        @unlink($tmpFile);
        return false;
    }

    if (!rename($tmpFile, $cacheFile)) {
        error_log("Failed to rename temp cache file to: " . $cacheFile);
        @unlink($tmpFile);
        return false;
    }

    // Match permissions
    @chmod($cacheFile, 0644);
    
    return true;
}


function catchdynamicforms($conn, $ttl = 3600, $force = false) {
    // Cache folder in parent directory (outside 'common'), matching catchroute
    $cacheDir  = dirname(__DIR__) . '/cache';
    $cacheFile = $cacheDir . '/dynamicforms.cache.php';

    // Ensure cache directory exists
    if (!is_dir($cacheDir)) {
        if (!mkdir($cacheDir, 0755, true)) {
            error_log("Failed to create cache directory: " . $cacheDir);
            return false;
        }
    }

    if (!is_writable($cacheDir)) {
        error_log("Cache directory is not writable: " . $cacheDir);
        return false;
    }

    // --- TTL check ---
    // Skip regeneration if the cache is fresh and caller didn't force it.
    if (!$force && file_exists($cacheFile)) {
        $age = time() - filemtime($cacheFile);
        if ($age < $ttl) {
            // Cache is still valid — nothing to do.
            return true;
        }
    }

    // --- Fetch forms from DB ---
    try {
        $sql = "SELECT id, name, title, description, details
                FROM dynamic_forms
                ORDER BY name";

        $stmt = $conn->query($sql);

        $forms = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // details comes back as a JSON string from PDO;
            // decode it so the cache holds a real array.
            $details = json_decode($row['details'], true);
            if (json_last_error() !== JSON_ERROR_NONE || !is_array($details)) {
                // Skip malformed rows rather than poisoning the cache.
                error_log("Skipping dynamic form '{$row['name']}' (id={$row['id']}): invalid JSON in details");
                continue;
            }

            $forms[strtolower($row['name'])] = [
                'Id'          => (int)$row['id'],
                'Name'        => $row['name'],
                'Title'       => $row['title'],
                'Description' => $row['description'],
                'Details'     => $details,
            ];
        }

    } catch (PDOException $e) {
        error_log("Failed to fetch dynamic forms: " . $e->getMessage());
        return false;
    }

    // --- Write cache atomically ---
    $cacheContent = '<?php' . PHP_EOL
                  . '// Auto-generated cache file — do not edit manually.' . PHP_EOL
                  . '// Generated: ' . date('Y-m-d H:i:s') . PHP_EOL
                  . 'return ' . var_export($forms, true) . ';';

    $tmpFile = $cacheFile . '.tmp.' . getmypid();

    if (file_put_contents($tmpFile, $cacheContent, LOCK_EX) === false) {
        error_log("Failed to write temp cache file: " . $tmpFile);
        @unlink($tmpFile);
        return false;
    }

    if (!rename($tmpFile, $cacheFile)) {
        error_log("Failed to rename temp cache file to: " . $cacheFile);
        @unlink($tmpFile);
        return false;
    }

    // Match permissions
    @chmod($cacheFile, 0644);

    return true;
}


/**
 * Insert a new record WITHOUT audit logging (MySQL)
 *
 * @param PDO $pdo PDO database connection
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs
 * @return int|string The ID of the newly inserted record
 * @throws PDOException on failure
 *
 * NOTE: Transaction must be managed by the calling script
 */
function insertRecordNoLog($pdo, $table, $data) {
    if (empty($table) || empty($data) || !is_array($data)) {
        throw new InvalidArgumentException("Invalid parameters for insertRecordNoLog()");
    }

    $columns      = array_keys($data);
    $placeholders = array_map(function($col) {
        return ":$col";
    }, $columns);

    $columnsStr      = implode(', ', $columns);
    $placeholdersStr = implode(', ', $placeholders);

    // MySQL: no RETURNING — use lastInsertId() after execute()
    $sql  = "INSERT INTO $table ($columnsStr) VALUES ($placeholdersStr)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);

    return $pdo->lastInsertId();
}

/**
 * Update records WITHOUT audit logging (MySQL)
 *
 * @param PDO $pdo PDO database connection
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs to update
 * @param array $where Associative array of conditions (e.g., ['id' => 5])
 * @return int Number of affected rows
 * @throws PDOException on failure
 *
 * NOTE: Transaction must be managed by the calling script
 */
function updateRecordNoLog($pdo, $table, $data, $where) {
    if (empty($table) || empty($data) || empty($where)) {
        throw new InvalidArgumentException("Invalid parameters for updateRecordNoLog()");
    }

    $whereClauses = [];
    $whereParams  = [];
    foreach ($where as $col => $val) {
        $whereClauses[]         = "$col = :where_$col";
        $whereParams[":where_$col"] = $val;
    }
    $whereStr = implode(' AND ', $whereClauses);

    $setClauses   = [];
    $updateParams = [];
    foreach ($data as $col => $val) {
        $setClauses[]           = "$col = :set_$col";
        $updateParams[":set_$col"] = $val;
    }
    $setStr = implode(', ', $setClauses);

    $updateParams = array_merge($updateParams, $whereParams);

    $updateSql  = "UPDATE $table SET $setStr WHERE $whereStr";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->execute($updateParams);

    return $updateStmt->rowCount();
}

/**
 * Delete records WITHOUT audit logging (MySQL)
 *
 * @param PDO $pdo PDO database connection
 * @param string $table Table name
 * @param array $where Associative array of conditions (e.g., ['id' => 5])
 * @return int Number of affected rows
 * @throws PDOException on failure
 *
 * NOTE: Transaction must be managed by the calling script
 */
function deleteRecordNoLog($pdo, $table, $where) {
    if (empty($table) || empty($where)) {
        throw new InvalidArgumentException("Invalid parameters for deleteRecordNoLog()");
    }

    $whereClauses = [];
    $whereParams  = [];
    foreach ($where as $col => $val) {
        $whereClauses[]         = "$col = :where_$col";
        $whereParams[":where_$col"] = $val;
    }
    $whereStr = implode(' AND ', $whereClauses);

    $deleteSql  = "DELETE FROM $table WHERE $whereStr";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->execute($whereParams);

    return $deleteStmt->rowCount();
}

