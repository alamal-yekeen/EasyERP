<?php
// connection params
// define('DB_SERVER', getenv('CORE_DB_SERVER'));
// define('DB_NAME', getenv('CORE_DBNAME'));
// define('DB_USER', getenv('CORE_DB_USER'));
// define('DB_PASSWORD', getenv('CORE_PASSWORD'));
// define('DB_PORT', getenv('CORE_PORT'));


define('DB_SERVER', 'localhost');
define('DB_NAME', 'Easy');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_PORT', '3306');

$config = [
    'app_name'            => 'FINAQ',
    'session_name'        => 'finaq_sid',
    'session_lifetime'    => 60 * 60 * 8,      // 8 hours
    'session_idle_limit'  => 60 * 30,          // 30 min idle
    'max_failed_attempts' => 5,
    'lockout_seconds'     => 15 * 60,          // 15 min lockout
    'rate_window_seconds' => 15 * 60,          // rate-limit window
    'rate_max_per_email'  => 10,
    'rate_max_per_ip'     => 30,
    'password_min_length' => 10,
    'cookie_secure'       => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
];


// base url
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$baseUrl = $protocol . '://' . $_SERVER['HTTP_HOST'];
define('BASE_URL', $baseUrl.'/');
