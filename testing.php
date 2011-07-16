<?php
$host = 'db.dotcloud.com:10927';
$password = '7dsfjkh78';
$username = 'latebarter';
$database = 'latebart';
mysql_connect($host,$username,$password) or die('woops');
mysql_select_db($database);
echo 'Hi!';

$result = mysql_query('SELECT * from formAnswers;');
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo 'Hi!';
echo $results;
mysql_close();
 

?>
