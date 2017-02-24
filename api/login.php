<?php
require_once('../connect.php');
require_once('../lib/lib-susi.php');
header("Content-Type: application/json");

$email = $_POST['email'];
$password = md5($_POST['password']);

$results = array();
$errors = array();

// are the fields complete?
if(empty($email) || empty($password)){
	if(!isset($errors['empty'])){ $errors['empty'] = array(); }
	array_push($errors['empty'], "Whoops! You forgot your email and password!");
}

// verify the user
if(verifyPassword($email, $password) === false){
	if(!isset($errors['fail'])){ $errors['fail'] = array(); }
	array_push($errors['fail'], "Wrong login info. Try again?");
}

if(empty($errors)){
	//ALL TESTS PASSED. LOG IN!
	$uid = getUID($email);
  	$_SESSION['loggedin'] = 1;
  	$_SESSION['uid'] = $uid;
	$result["success"] = true;
}else{
	$result["success"] = false;
	$result["errors"] = $errors;
}

echo json_encode($result);
?>