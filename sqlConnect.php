<?php

$apiKey = 'EHDB-ZWQN-EKXT-VV5D';

$host = 'db.latebart.dotcloud.com:10926';
$password = '7dsfjkh78';
$username = 'latebarter';
$database = 'latebart';
mysql_connect($host,$username,$password) or die('woops');
mysql_select_db($database);
echo 'Hi!';


?>