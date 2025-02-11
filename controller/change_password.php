<?php

require_once __DIR__ . '/../config/db.php';
check_login();

$user_id = $_SESSION['user']['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['auto_generate']) && $_POST['auto_generate'] == 'on') {
        $generated_password = $_POST['new_password']; 
        $hashed_password = password_hash($generated_password, PASSWORD_DEFAULT);
        
    } else {
        if (empty($_POST['new_password']) || empty($_POST['confirm_password'])) {
            set_flash_message('error','Please enter and confirm your new password or select auto-generate.');
        } elseif ($_POST['new_password'] !== $_POST['confirm_password']) {
            set_flash_message('error','Passwords do not match.');
        } else {
            $new_password = $_POST['new_password'];            
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($old_password);
            $stmt->fetch();
            $stmt->close();
            if (password_verify($new_password, $old_password) || md5($new_password) === $old_password) {
                set_flash_message('error','New password cannot be the same as the old password.');
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            }
        }
    }

    if (!isset($error)) {
        $updatePassword = "UPDATE users SET password = ?, last_password_change = NOW() WHERE id = ?";
        $stmt = $conn->prepare($updatePassword);
        $stmt->bind_param("si", $hashed_password, $user_id);
        if ($stmt->execute()) {            
            set_flash_message('success','Password change successfully.');
            redirect_route("change_password");
        } else {
            set_flash_message('error','Error updating password. Please try again to create new password filled.');
        }

        $stmt->close();
    }
}
?>

