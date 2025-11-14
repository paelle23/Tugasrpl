<?php
session_start();

// Base URL configuration
define('BASE_URL', 'http://localhost/inventory-lab/');

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'inventory_lab');
define('DB_USER', 'root');
define('DB_PASS', '');

// Session timeout (dalam detik)
define('SESSION_TIMEOUT', 3600);

// Include database class dan functions
require_once 'database.php';
require_once '../includes/functions.php';

// Create database instance
$database = new Database();
$db = $database->getConnection();

// Auto login dengan remember token
if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
    $token = $_COOKIE['remember_token'];

    $query = "SELECT id, username, full_name, role FROM users WHERE remember_token = :token AND status = 'active'";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['logged_in'] = true;
        $_SESSION['login_time'] = time();
    }
}

// Check session timeout untuk user yang sudah login
if (isset($_SESSION['user_id'])) {
    checkSessionTimeout();
}
?>
