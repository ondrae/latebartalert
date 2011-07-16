<?
include sqlConnect.php

$result = mysql_query('SELECT * from formAnswers');
if (!$result) {
    die('Invalid query: ' . mysql_error());
}
echo 'Hi!';
echo $results;
mysql_close();
 

?>
