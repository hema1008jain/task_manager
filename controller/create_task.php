<?php
require_once __DIR__ . '/../config/db.php';
check_user_login();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user']['user_id'];
    $start_time = $_POST['start_time'];
    $stop_time = $_POST['stop_time'];
    $notes = $_POST['notes'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tasks (user_id, start_time, stop_time, notes, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?,now(),now())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $start_time, $stop_time, $notes, $description);
    $stmt->execute();
    var_dump($stmt);
    $stmt->close();
    set_flash_message('success','Task created successfully.');
    redirect_route("dashboard");
    
}
?>

