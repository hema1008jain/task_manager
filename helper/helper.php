<?php 
require_once __DIR__ . '/../config/constant.php';

function redirect_route($routeName){
   header("Location: index.php?route=".$routeName);
   die();
}

function set_flash_message($type,$msg){
   $_SESSION['flash_msg']=['type'=>$type,'msg'=>$msg];
}

function show_flash_message() {
   if (isset($_SESSION['flash_msg'])) {
      $type = $_SESSION['flash_msg']['type'] === 'success' ? 'alert-success' : 'alert-danger';       
      echo "<div class='alert $type alert-dismissible fade show' role='alert'>
               {$_SESSION['flash_msg']['msg']}
               <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
             </div>";
      unset($_SESSION['flash_msg']);
   }
}

function route_run($route) {
   require_once(__DIR__ ."/../controller/".$route. ".php");   
   $excluded_routes = ['download_report', 'submit_tasks'];
   if (!in_array($route, $excluded_routes)) {
       require_once(__DIR__ . "/../view/" . $route . ".php");
   }
}

function check_admin_login() {
   if (!isset($_SESSION['user']) || $_SESSION['user']['role_name']!='Admin') {
      redirect_route("login");
  }
}
function check_user_login() {
   if (!isset($_SESSION['user']) || $_SESSION['user']['role_name']!='User') {
      redirect_route("login");
  }
}
function check_login() {
   if (!isset($_SESSION['user'])){
      redirect_route("login");
  }
}


?>