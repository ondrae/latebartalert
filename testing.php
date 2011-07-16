<?php
$envfilepath = $_ENV['HOME'] + '/environment.json'
$environment = json_decode(file_get_contents($envfilepath),true);
$db_host = $environment['DOTCLOUD_DATA_MYSQL_HOST'];
$db_port = $environment['DOTCLOUD_DATA_MYSQL_PORT'];
$db_username = $environment['DOTCLOUD_DATA_MYSQL_LOGIN'];
$db_password = $environment['DOTCLOUD_DATA_MYSQL_PASSWORD'];
$database = 'latebart';

mysql_connect($db_host,$db_username,$db_password) or die('woops');
mysql_select_db($database);

$result = mysql_query('SELECT startStation from formAnswers limit 1;');

print $result;
echo $result;
mysql_close();
 

?>