<?
include sqlConnect.php

openDatabase();
$result = mysql_query('SELECT * from formAnswers');
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

echo $results;
mysql_close();
 

?>
