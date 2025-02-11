<?php
require_once __DIR__ . '/../config/db.php';

check_admin_login();

$sql = "SELECT users.first_name, users.last_name, tasks.start_time, tasks.stop_time, tasks.notes, tasks.description 
        FROM tasks 
        JOIN users ON tasks.user_id = users.id
        Where tasks.status = 1 
        ORDER BY tasks.start_time DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=user_report.csv');

    $output = fopen('php://output', 'w');

    fputcsv($output, ['User Name', 'Start Time', 'Stop Time', 'Notes', 'Description']);

    while ($row = $result->fetch_assoc()) {
        $user_name = $row['first_name'] . ' ' . $row['last_name'];
        fputcsv($output, [$user_name, $row['start_time'], $row['stop_time'], $row['notes'], $row['description']]);
    }
    
    fclose($output);
} else {
    set_flash_message('error','Tasks list Empty.');
    redirect_route("dashboard"); 
}
?>
