<?php
require_once __DIR__ . '/../config/db.php';

check_user_login();

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $user_id = $_SESSION['user']['user_id'];

    $sql = "DELETE FROM tasks WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $task_id, $user_id);

    if ($stmt->execute()) {
        set_flash_message('success','Task deleted successfully.');
       redirect_route("dashboard");
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
}
?>
