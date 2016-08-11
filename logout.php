<?php
require_once '../include/functions.php';
 
sec_session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
session_destroy();
header('Location: /login.php'); 
exit;

?>
