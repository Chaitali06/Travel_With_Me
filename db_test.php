<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>1. Environment Variables:</h3>";
echo "<pre>";
echo "getenv('DB_HOST'): " . var_export(getenv('DB_HOST'), true) . "\n";
echo "getenv('DB_USER'): " . var_export(getenv('DB_USER'), true) . "\n";
echo "getenv('DB_PASS'): " . var_export(getenv('DB_PASS'), true) . "\n";
echo "getenv('DB_NAME'): " . var_export(getenv('DB_NAME'), true) . "\n";
echo "</pre>";

echo "<h3>2. Constants before include:</h3>";
echo "<pre>";
echo "defined('DB_HOST'): " . var_export(defined('DB_HOST'), true) . "\n";
echo "defined('DB_PASS'): " . var_export(defined('DB_PASS'), true) . "\n";
echo "</pre>";

echo "<h3>3. Testing Possible Config Paths:</h3>";
$possibleConfigs = [
    __DIR__ . '/config.php',
    __DIR__ . '/admin/inc/config.php',
    __DIR__ . '/admin/inc/../../config.php',
    dirname(__DIR__) . '/config.php',
    (isset($_SERVER['DOCUMENT_ROOT']) && $_SERVER['DOCUMENT_ROOT']) ? rtrim($_SERVER['DOCUMENT_ROOT'], '/\\') . '/config.php' : null,
];

foreach ($possibleConfigs as $p) {
    echo "Path: " . htmlspecialchars($p) . " => " . (file_exists($p) ? "<b style='color:green'>EXISTS</b>" : "<span style='color:red'>MISSING</span>") . "<br>";
}

echo "<h3>4. Loading conn.php directly:</h3>";
try {
    require_once __DIR__ . '/admin/inc/conn.php';
    echo "<p style='color:green; font-weight:bold;'>conn.php loaded successfully! Connection works!</p>";
} catch (Throwable $e) {
    echo "<p style='color:red; font-weight:bold;'>conn.php error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
