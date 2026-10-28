<?php
/**
 * Production Database Configuration for CloudPanel
 * 
 * If using CloudPanel:
 * Option 1: You can set these environment variables directly in CloudPanel -> Site -> PHP Settings -> Environment Variables.
 * Option 2: Copy this file to 'config.php' in the root directory and update the credentials below.
 */

define('DB_HOST', '127.0.0.1');      // Usually 127.0.0.1 or localhost
define('DB_NAME', 'your_db_name');    // CloudPanel Database Name
define('DB_USER', 'your_db_user');    // CloudPanel Database User
define('DB_PASS', 'your_db_password');// CloudPanel Database Password
define('DB_PORT', 3306);
