<?php
$loggedin = $_SESSION['loggedin'];
$user = $_SESSION['username'];
$uid = $_SESSION['uid'];

function login($username, $password){
	$query = mysql_query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
	if(mysql_num_rows($query) > 0){
		$row = mysql_fetch_assoc($query);
		$uid = $row['uid'];
		$_SESSION['loggedin'] = 1;
		$_SESSION['uid'] = $uid;
		$_SESSION['username'] = $username;
		$loggedin = 1;
		header("Location: /");
	}else{
		$loggedin = 0;
		$_SESSION['loggedin'] = 0;
	}
}

function getLatestUpdate($uid){
	$query = mysql_query("SELECT * FROM log WHERE uid = '$uid' ORDER BY entry_time DESC LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($query) > 0){
		$row = mysql_fetch_assoc($query);
		$lastupdate = $row['entry_time'];		
	}else{
		$lastupdate = 0;
	}
	return $lastupdate;
}

function updateWeight($uid, $weight){
	$query = mysql_query("INSERT INTO log(uid, weight) VALUES ($uid, '$weight')") or die(mysql_error());
	header("Location: /");
}

function percentChangeTotal($uid){
	$query = mysql_query("SELECT * FROM log WHERE uid = $uid ORDER BY entry_time ASC LIMIT 1");
	$row = mysql_fetch_assoc($query);
	$start = $row['weight'];
	$query = mysql_query("SELECT * FROM log WHERE uid = $uid ORDER BY entry_time DESC LIMIT 1");
	$row = mysql_fetch_assoc($query);
	$current = $row['weight'];
	if($current == 0){$current = 1;}
	if($start == 0){$start = 1;}
	$change = round(($current - $start)/$start, 2);
	return $change;
}

function weightLossTotal($uid){
	$query = mysql_query("SELECT * FROM log WHERE uid = $uid ORDER BY entry_time ASC LIMIT 1");
	$row = mysql_fetch_assoc($query);
	$start = $row['weight'];
	$query = mysql_query("SELECT * FROM log WHERE uid = $uid ORDER BY entry_time DESC LIMIT 1");
	$row = mysql_fetch_assoc($query);
	$current = $row['weight'];
	$change = $start - $current;
	return $change;
}

$today = date('Y-m-d', time());

if($_GET['q'] == "logout"){
	$_SESSION = array();
	session_destroy();
	header("Location: /");
}

if(!empty($_POST['username']) && !empty($_POST['password'])){
	$username = mysql_real_escape_string($_POST['username']);
	$password = md5(mysql_real_escape_string($_POST['password']));
	$login = login($username, $password);
}

if(!empty($_POST['weight']) && !empty($_POST['uid'])){
	updateWeight($uid, $_POST['weight']);
}
?>