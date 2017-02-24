<?php
$loggedin = $_SESSION['loggedin'];
$uid = $_SESSION['uid'];

function getCurrentUsername($uid){
	global $link;

	$q = mysqli_query($link, "SELECT * FROM users WHERE uid = $uid");
	$r = mysqli_fetch_assoc($q);
	$nickname = $r['username'];

	return $nickname;
}

function getLatestUpdate($uid){
	global $link;

	$query = mysqli_query($link, "SELECT * FROM log WHERE uid = '$uid' ORDER BY entry_time DESC LIMIT 1") or die(mysql_error());
	if(mysql_num_rows($query) > 0){
		$row = mysql_fetch_assoc($query);
		$lastupdate = $row['entry_time'];		
	}else{
		$lastupdate = 0;
	}
	return $lastupdate;
}

function percentChangeTotal($uid){
	global $link;

	$query = mysqli_query($link, "SELECT * FROM log WHERE uid = $uid ORDER BY entry_time ASC LIMIT 1");
	$row = mysqli_fetch_assoc($query);
	$start = $row['weight'];
	$query = mysqli_query($link, "SELECT * FROM log WHERE uid = $uid ORDER BY entry_time DESC LIMIT 1");
	$row = mysqli_fetch_assoc($query);
	$current = $row['weight'];
	if($current == 0){$current = 1;}
	if($start == 0){$start = 1;}
	$change = round(($current - $start)/$start, 2);
	return $change;
}

function weightLossTotal($uid){
	global $link;

	$query = mysqli_query($link, "SELECT * FROM log WHERE uid = $uid ORDER BY entry_time ASC LIMIT 1");
	$row = mysqli_fetch_assoc($query);
	$start = $row['weight'];
	$query = mysqli_query($link, "SELECT * FROM log WHERE uid = $uid ORDER BY entry_time DESC LIMIT 1");
	$row = mysqli_fetch_assoc($query);
	$current = $row['weight'];
	$change = round($start - $current, 2);
	return $change;
}

function updateWeight($uid, $weight){
	global $link;
	$query = mysqli_query($link, "INSERT INTO log(uid, weight) VALUES ($uid, '$weight')") or die(mysql_error());
	$percentchange = percentChangeTotal($uid);
	$q = mysqli_query($link, "UPDATE users SET latest_percent_change = $percentchange WHERE uid = $uid");
	header("Location: /home.php");
}

function lastUpdate($uid){
	global $link;

	$query = mysqli_query($link, "SELECT * FROM log WHERE uid = $uid ORDER BY entry_time DESC LIMIT 1");
	$row = mysqli_fetch_assoc($query);
	$date = $row['entry_time'];
	$date = date('n/j/y', strtotime($date));
	return $date;
}

function getLeaderboard(){
	global $link;

	$leaderboard = array();
	$q = mysqli_query($link, "SELECT * FROM users ORDER BY latest_percent_change ASC");
	while($r = mysqli_fetch_assoc($q)){
		$leaderboard[] = $r;
	}

	return $leaderboard;
}

$today = date('Y-m-d', time());

if(!empty($_POST['weight']) && !empty($_POST['uid'])){
	updateWeight($uid, $_POST['weight']);
}
?>
