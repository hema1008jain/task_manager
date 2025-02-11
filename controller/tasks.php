<?php
require_once __DIR__ . '/../config/db.php';
check_admin_login();
$sql = "SELECT tasks.*, users.first_name, users.last_name 
            FROM tasks 
            JOIN users ON tasks.user_id = users.id 
            WHERE tasks.status = 1 
            ORDER BY tasks.start_time DESC";

$tasks = $conn->query($sql);
?>


