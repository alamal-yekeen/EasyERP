<?php
// start session
session_start();
//db
require_once 'common/connectserver.php';

// initialize the functions
require_once 'common/functions.php';

// initialize the sessions
// Cache file path (adjust relative path if this script is in a subdirectory)
$cacheDir = __DIR__ . '/cache';
$cacheFile = $cacheDir . '/routes.cache.php';

// Check if cache exists and is fresh (e.g., not older than 1 hour)
$cacheAge = 3600; // 1 hour in seconds
$useCache = file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheAge);

if ($useCache) {
    // Load routes directly from the cache file
    $routes = include $cacheFile;
} else {
    // Cache is missing or expired, regenerate it using catchroute()
    // (Assumes $conn is already established via your config/connection script)
    if (catchroute($conn)) {
        $routes = include $cacheFile;
    } else {
        // Fallback or handle failure if catchroute() couldn't write the cache
        http_response_code(500);
        die(json_encode(['error' => 'Failed to generate or load route cache.']));
    }
}

// $action = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
// $action = strtolower($action);

$url = isset($_GET['url']) ? $_GET['url'] : '';
$action = strtolower($url);


try {
    // Hardcoded routes (keep these as they are for performance)
    $hardcodedRoutes = [
        '' => 'login.php',
        'login' => 'login.php',
        'loginbk' => 'Engine/general/loginbk.php',
        'logout' => 'Engine/general/loginbk.php',
        'home' => 'home.php',
        'dashboard' => 'pages/dashboard.php',
        'inbox' => 'pages/inbox.php',
        'participated' => 'pages/participated.php'
    ];
    
    if (isset($hardcodedRoutes[$action])) {
        include $hardcodedRoutes[$action];
        exit;
    }
    
    // Check cached routes
    if (isset($routes[$action])) {
        $route = $routes[$action];
        $file = $route['Type'] == 0 
            ? 'engine/' . strtolower($route['Module']) . '/' . $route['Page']
            : strtolower($route['Module']) . '/' . $route['Page'];
        
        if (file_exists($file)) {
            include $file;
            exit;
        } else {
            // echo 'the Resource is not available';
            require 'pages/404_noroute.php';
            
        }
    } else {
        require 'pages/404.php';
        exit;
    }

    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

?>