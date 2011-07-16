<?php
$host = 'db.dotcloud.com:10927';
$password = '7dsfjkh78';
$username = 'latebarter';
$database = 'latebart';
mysql_connect($host,$username,$password) or die('woops');
mysql_select_db($database);

$result = mysql_query('SELECT startStation from formAnswers limit 1;');


echo $results;
mysql_close();
 

?>
