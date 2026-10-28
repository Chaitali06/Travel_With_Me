<?php
/**
 * Database Connection Configuration
 */

// Check for optional custom config file across possible root paths
$possibleConfigs = [
    __DIR__ . '/config.php',
    __DIR__ . '/../../config.php',
    dirname(__DIR__, 2) . '/config.php',
    (isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER['DOCUMENT_ROOT']) ? rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') . '/config.php' : null,
];

foreach ($possibleConfigs as $cfg) {
    if ($cfg && file_exists($cfg)) {
        include_once($cfg);
        break;
    }
}

// Auto-detect localhost (WampServer) vs Production (CloudPanel)
$isLocalhost = (
    php_sapi_name() === 'cli' ||
    (isset($_SERVER['HTTP_HOST']) && (
        strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || 
        strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false
    )) ||
    (isset($_SERVER['SERVER_NAME']) && (
        $_SERVER['SERVER_NAME'] === 'localhost' || 
        $_SERVER['SERVER_NAME'] === '127.0.0.1'
    ))
);

if ($isLocalhost) {
    // Local WampServer Database Settings
    $servername = "127.0.0.1";
    $username   = "root";
    $password   = "";
    $dbname     = "traveldb";
    $port       = 3306;
} else {
    // Production CloudPanel Database Settings (from config.php or environment)
    $servername = (defined('DB_HOST') && DB_HOST !== '') ? DB_HOST : (getenv('DB_HOST') ?: "127.0.0.1");
    $username   = (defined('DB_USER') && DB_USER !== '') ? DB_USER : (getenv('DB_USER') ?: "root");
    $password   = (defined('DB_PASS') && DB_PASS !== '') ? DB_PASS : (getenv('DB_PASS') !== false ? getenv('DB_PASS') : "");
    $dbname     = (defined('DB_NAME') && DB_NAME !== '') ? DB_NAME : (getenv('DB_NAME') ?: "traveldb");
    $port       = (defined('DB_PORT') && DB_PORT) ? (int)DB_PORT : (getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306);
}

// Enable error reporting for MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Set charset to utf8mb4 for better character support
    $conn->set_charset("utf8mb4");

} catch (Exception $e) {
    // Log the error and show the exact error message
    error_log($e->getMessage());
    exit('Database Connection Error: ' . htmlspecialchars($e->getMessage()));
}
?>