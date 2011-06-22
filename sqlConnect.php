<?php

$apiKey = 'EHDB-ZWQN-EKXT-VV5D';

//Opens the MySQL Database, remember to close it!
function openDatabase(){
	$host = 'mysql.latebart.dotcloud.com:5989';
	$username = 'latebart';
	$database = 'latebart';
	$password = '9832jfh23890hj';
	$table = "commuters";
	mysql_connect($host,$username,$password) or die('woops');
	mysql_select_db($database);
}


?>