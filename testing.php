<?php
$envfilepath = $_ENV['HOME'] + '/environment.json';
$environment = json_decode(file_get_contents($envfilepath),true);
$db_host = $environment['DOTCLOUD_DB_MYSQL_HOST'];
$db_port = $environment['DOTCLOUD_DB_MYSQL_PORT'];
$db_username = $environment['DOTCLOUD_DB_MYSQL_LOGIN'];
$db_password = $environment['DOTCLOUD_DB_MYSQL_PASSWORD'];
$DBbase = 'latebart';

mysql_connect($db_host,$db_username,$db_password) or die('woops');
mysql_select_db($DBbase);

$result = mysql_query('SELECT startStation from formAnswers;');

print $result;
echo $result;
mysql_close();
 

?>