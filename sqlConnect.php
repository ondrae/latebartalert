<?php

$apiKey = 'EHDB-ZWQN-EKXT-VV5D';

//Opens the MySQL Database, remember to close it!
function openDatabase(){
	$envfilepath = $_ENV['HOME'] + '/environment.json'
	$environment = json_decode(file_get_contents($envfilepath),true);
	$host = $environment['DOTCLOUD_DATA_MYSQL_HOST'];
	$db_port = $environment['DOTCLOUD_DATA_MYSQL_PORT'];
	$password = '7dsfjkh78';
	$username = 'latebarter';
	$database = 'latebart';
	mysql_connect($host,$username,$password) or die('woops');
	mysql_select_db($database);
}

?>