<?php
require_once __DIR__ . '/../config/db.php';

check_user_login();

$task_id = $_GET['id'];
$user_id = $_SESSION['user']['user_id'];;

$sql = "SELECT * FROM tasks WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $task_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();

if (!$task) {
    set_flash_message('error','Task Not found.');
    redirect_route("dashboard"); 
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $start_time = $_POST['start_time'];
    $stop_time = $_POST['stop_time'];
    $notes = $_POST['notes'];
    $description = $_POST['description'];

    $update_sql = "UPDATE tasks SET start_time=?, stop_time=?, notes=?, description=? ,updated_at=NOW() WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $start_time, $stop_time, $notes, $description, $task_id);

    if ($update_stmt->execute()) {
        set_flash_message('success','Task updated successfully.');
        redirect_route("dashboard");        
    } else {
        echo "Error: " . $conn->error;
    }
    $update_stmt->close();
}

?>

