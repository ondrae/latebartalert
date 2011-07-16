<?php

$apiKey = 'EHDB-ZWQN-EKXT-VV5D';

//Opens the MySQL Database, remember to close it!
function openDatabase(){
	$host = 'localhost';
	$password = '7dsfjkh78';
	$username = 'latebarter';
	$database = 'latebart';
	mysql_connect($host,$username,$password) or die('woops');
	mysql_select_db($database);
}

?>