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

// Verify Hash
function verifyHash($email, $hash){
	global $link;

	$email = mysqli_real_escape_string($link, $email);
	$hash = mysqli_real_escape_string($link, $hash);

	$q = mysqli_query($link, "SELECT * FROM users WHERE user_email = '$email' AND reset_hash = '$hash' AND reset_hash_timeout > NOW()");
	if(mysqli_num_rows($q) > 0){
		return true;
	}else{
		return false;
	}
}


function emailPasswordReset($email, $hash){
	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'email-smtp.us-east-1.amazonaws.com';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'AKIAIEPBK4G5SMAFTGKA';                 // SMTP username
	$mail->Password = 'Ao6lpa/isjP45LTUEHmM0KctXY5DdRQRshODyXnA2tRR';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('beck@nomadfly.me', 'NomadProof');
	$mail->addAddress($email);     // Add a recipient
	$mail->addReplyTo('beck@nomadfly.me', 'NoReply');
	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = 'Reset your NomadProof Password';
	$mail->Body    = "<h3>Reset your NomadProof Password</h3><p>Please follow this link to reset your password within the next 3 hours:</p>
	<p><a href='http://nomadproof.co/password-reset?email=$email&pwhash=$hash'>Reset your password</a></p>
	<p>Cheers,<br />
	NomadProof</p>";
	$mail->AltBody = "Reset your NomadProof Password \n Please follow this link to reset your password within the next 3 hours:\n http://nomadproof.co/password-reset?email=$email&pwhash=$hash\n Cheers,\n NomadProof";

	if(!$mail->send()) {
	    // echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
	    // echo 'Message has been sent';
	}
}
?>