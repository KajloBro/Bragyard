<?php 

session_start();
$_SESSION = array();
session_destroy();
session_regenerate_id();
header('Location: login.php');

?>