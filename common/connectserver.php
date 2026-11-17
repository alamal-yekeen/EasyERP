<?php 

require_once 'common/config.php';

// Set timezone
date_default_timezone_set('Africa/Lagos');

try {
    // Create MySQL PDO connection string (including charset for security and UTF-8 support)
    $dsn = "mysql:host=" . DB_SERVER . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    
    // PDO options
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_PERSISTENT => false,
    ];
    
    // Establish connection
    $conn = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    
    // Assign secondary connection reference
    $connr = $conn;
    
    // Connection successful
    // echo "Connection established successfully!<br />";
    
} catch (PDOException $e) {
    // Connection failed
    // die("Connection failed: " . $e->getMessage());
    echo "Connection failed: Unable to connect to the database. Please check your configuration.";
    exit();
}