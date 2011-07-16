<?php

$apiKey = 'EHDB-ZWQN-EKXT-VV5D';

//Opens the MySQL Database, remember to close it!
function openDatabase(){
	$host = 'mysql@2810db75.dotcloud.com:10926';
	$password = '7dsfjkh78';
	$username = 'latebarter';
	$database = 'latebart';
	mysql_connect($host,$username,$password) or die('woops');
	mysql_select_db($database);
}

?>