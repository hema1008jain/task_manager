<?php
require_once __DIR__ . '/../config/db.php';
check_user_login();
header('Content-Type: application/json');
$response = ['status' => 'error', 'message' => 'Something went wrong.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_ids'])) {
    session_start();    
    $task_ids = $_POST['task_ids']; 
    $user_id = $_SESSION['user']['user_id'];;

    if (!is_array($task_ids) || empty($task_ids)) {
        echo json_encode(['status' => 'error', 'message' => 'No tasks selected.']);
        exit();
    }

    $placeholders = implode(',', array_fill(0, count($task_ids), '?'));

    $sql = "UPDATE tasks SET status = 1, updated_at = NOW() WHERE id IN ($placeholders) AND user_id = ?";
    
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $conn->error]);
        exit();
    }

    $types = str_repeat('i', count($task_ids)) . 'i';
    $params = array_merge($task_ids, [$user_id]);

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $_SESSION['flash_msg'] = ['type' => 'success', 'msg' => 'Selected tasks submitted successfully.'];
        echo json_encode(['status' => 'success', 'message' => 'Selected tasks submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error submitting tasks: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
