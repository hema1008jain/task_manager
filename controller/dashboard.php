<?php
require_once __DIR__ . '/../config/db.php';

check_login();

$user_id = $_SESSION['user']['user_id'];
$role_name = $_SESSION['user']['role_name'];
$first_name = $_SESSION['user']['first_name'];
$last_name = $_SESSION['user']['role_last_namename'];

$sql = "SELECT last_password_change FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($last_password_change);
$stmt->fetch();
$stmt->close();

if (!$last_password_change || (time() - strtotime($last_password_change)) > (30 * 24 * 60 * 60)) {
    redirect_route("change_password");
}

if ($role_name === "Admin") {
    $sql = "SELECT tasks.*, users.first_name, users.last_name 
            FROM tasks 
            JOIN users ON tasks.user_id = users.id 
            WHERE tasks.status = 1 
            ORDER BY tasks.start_time DESC";
    
    $tasks = $conn->query($sql);
} else {
    $sql = "SELECT * FROM tasks WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $tasks = $stmt->get_result();
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_task'])) {
    $task_id = $_POST['task_id'];
    $sql = "UPDATE tasks SET status = 1 WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $task_id, $user_id);
    if ($stmt->execute()) {
        set_flash_message('success','Task submitted successfully.');
        redirect_route("dashboard");
    }
    $stmt->close();
}
?>


