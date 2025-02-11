<?php
require_once __DIR__ . '/helper/helper.php';
route_run($_REQUEST['route']??'login');
?>