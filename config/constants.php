<?php
// ✅ Start session only once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Prevent constants from being redefined
if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/food-order/');
}
if (!defined('LOCALHOST')) {
    define('LOCALHOST', 'localhost');
}
if (!defined('DB_USERNAME')) {
    define('DB_USERNAME', 'root');
}
if (!defined('DB_PASSWORD')) {
    define('DB_PASSWORD', '');
}
if (!defined('DB_NAME')) {
    define('DB_NAME', 'food-order'); // ✅ make sure your actual database name is food_order
}

// ✅ Connect to Database only once
if (!isset($conn)) {
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
}
?>
