<?php
session_start();
$_SESSION = [];
session_destroy();
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}
set_flash_message('success', 'You have been logged out successfully.');
redirect_route("login");
?>
?>
