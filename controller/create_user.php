<?php
require_once __DIR__ . '/../config/db.php';
check_admin_login();

$sql = "SELECT users.*, roles.role_name FROM users 
        JOIN roles ON users.role_id = roles.id";
$result = $conn->query($sql);

$roles = $conn->query("SELECT * FROM roles");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role_id = $_POST['role_id'];

    $sql = "INSERT INTO users (first_name, last_name, email, phone, password, role_id, last_password_change, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW(), NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $password, $role_id);

    if ($stmt->execute()) {
        set_flash_message('success','User created successfully.');
        redirect_route("users");       
    } else {
        set_flash_message('error',  $stmt->error );
    }
    $stmt->close();
}
?>


