<?php
require_once('../connect.php');

//CREATE A FREE SUBSCRIBER
require_once('../lib/lib-susi.php');

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

// are the fields complete? 
if(empty($email)){
	if(!isset($errors['empty'])){ $errors['empty'] = array(); }
	array_push($errors['empty'], "Missing Origin");
}

// are the fields complete?
if(empty($password)){
	if(!isset($errors['empty'])){ $errors['empty'] = array(); }
	array_push($errors['empty'], "Missing Date");
}

// are the fields complete?
if(empty($username)){
	if(!isset($errors['empty'])){ $errors['empty'] = array(); }
	array_push($errors['empty'], "Missing Date");
}

if(empty($errors)){
	//ALL TESTS PASSED. ADD!
	$uid = registerUser($email, $username, $password);
	$_SESSION['uid'] = $uid;
	$_SESSION['username'] = $username;
	$_SESSION['loggedin'] = 1;

	$result["success"] = true;
}else{
	$result["success"] = false;
	$result["errors"] = $errors;
}

echo json_encode($result);
?>