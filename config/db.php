<?php
session_start();
require_once __DIR__ . '/../config/constant.php';

$conn = new mysqli(HOST, DB_USER, DB_PWD, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
