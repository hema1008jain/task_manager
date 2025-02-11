<?php
require_once __DIR__ . '/../config/db.php';
check_admin_login();
$sql = "SELECT users.*, roles.role_name FROM users 
        JOIN roles ON users.role_id = roles.id";
$result = $conn->query($sql);
?>

