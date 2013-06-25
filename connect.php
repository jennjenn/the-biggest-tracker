<?php
session_start();


/********** DB CONNECT ***********/
function mySQLconnect(){

	// PROD DB:
		$hostname = "";
		$username = "";
		$password = "";
		$database = "";


	$link = mysql_connect($hostname,$username,$password);
	mysql_select_db($database) or die("Unable to select database");
}

mySQLconnect();

?>
