<?php
// Create User
function registerUser($email, $username, $password){
	global $link;

	$email = mysqli_real_escape_string($link, $email);
	$username = mysqli_real_escape_string($link, $username);
	$pasword = mysqli_real_escape_string($link, $password);
	$password = md5($password);

	$q = mysqli_query($link, "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')");
	$r = mysqli_insert_id($link);
	
	return $r;
}

// get UID for Email
function getUID($email){
	global $link;

	$email = mysqli_real_escape_string($link, $email);
	$q = mysqli_query($link, "SELECT * FROM users WHERE email = '$email'");
	if(mysqli_num_rows($q) > 0){
		$r = mysqli_fetch_assoc($q);
		$uid = $r['uid'];

		return $uid;
	}else{
		return false;
	}
}	

// Set RESET PW HASH
function resetPW($email){
	global $link;

	$email = mysqli_real_escape_string($link, $email);
	$hash = md5(time()) . md5($email) . md5('alpaca');
	// $hashtimeout = time() + 10800;

	$q = mysqli_query($link, "UPDATE users SET user_password = '', reset_hash = '$hash', reset_hash_timeout = NOW() + 10800 WHERE user_email = '$email'");

	return $hash;
}

// Set NEW PASSWORD
function updatePW($email, $password){
	global $link;

	$email = mysqli_real_escape_string($link, $email);
	$password = mysqli_real_escape_string($link, $password);
	$password = md5($password);

	$q = mysqli_query($link, "UPDATE users SET user_password = '$password', reset_hash = '', reset_hash_timeout = NULL WHERE user_email = '$email'");

	return $hash;
}

// Check For User
function userExists($uid){
	global $link;

	$uid = mysqli_real_escape_string($link, $uid);
	$q = mysqli_query($link, "SELECT * FROM users WHERE user_id = $uid");
	if(mysqli_num_rows($q) > 0){
		return true;
	}else{
		return false;
	}
}

// Verify Password
function verifyPassword($email, $password){
	global $link;

	$password = mysqli_real_escape_string($link, $password);

	$q = mysqli_query($link, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
	if(mysqli_num_rows($q) > 0){
		return true;
	}else{
		return false;
	}
}
?>