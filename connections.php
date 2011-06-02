<?php

$apiKey = 'EHDB-ZWQN-EKXT-VV5D';

//Opens the MySQL Database, remember to close it!
function openDatabase(){
	$host = 'mysql50-91.wc1.dfw1.stabletransit.com';
	$username = '536610_testuser';
	$database = '536610_commuters';
	$password = 'testpassword';
	mysql_connect($host,$username,$password) or die('woops');
	mysql_select_db($database);
}


?>