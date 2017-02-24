<?php 
require_once('connect.php');;

	unset($_COOKIE['uid']);
	$_SESSION = array();
	session_destroy(); 

header("Location: /");
?>