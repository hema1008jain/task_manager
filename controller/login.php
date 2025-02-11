<?php
require_once __DIR__ . '/../config/db.php';
if (isset($_SESSION['user'])) {   
    redirect_route("dashboard");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT users.*, roles.role_name FROM users 
            JOIN roles ON users.role_id = roles.id 
            WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user) {
        $db_password = $user['password'];
        if (password_verify($password, $db_password) || md5($password) === $db_password) {
            $session_data =  ['user_id'=> $user['id'],'first_name'=>$user['first_name'], 'last_name'=>$user['last_name'], 'role_name'=>$user['role_name']];
            $_SESSION['user'] = $session_data;
            $updateLoginTime = "UPDATE users SET last_login = NOW() WHERE id = ?";
            $stmt = $conn->prepare($updateLoginTime);
            $stmt->bind_param("i", $user['id']);
            $stmt->execute();
            $stmt->close();
            if (md5($password) === $db_password || !$user['last_password_change'] || (time() - strtotime($user['last_password_change'])) > (30 * 24 * 60 * 60)) {
                set_flash_message('error','Hi '.$user['first_name']. ', Your current password is not secure, please make it secure.');
                redirect_route("change_password");
            }
            set_flash_message('success','Hi '.$user['first_name']. ', You are login successfully.');
            redirect_route("dashboard");
        } else {
            set_flash_message('error','Invalid email or password.');            
        }
    } else {
        set_flash_message('error','Invalid email or password.');   
    }
}
