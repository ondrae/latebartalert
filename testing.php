<?php

# Import environment settings from DotCloud
$envjson = json_decode(file_get_contents("/home/dotcloud/environment.json"),true);

# Create MySQL Connection
mysql_connect($envjson['DOTCLOUD_DB_MYSQL_HOST'],
                     'latebarter',         # username
                     '7dsfjkh78',   # password
                     'latebart',       # db name
                     $envjson['DOTCLOUD_DB_MYSQL_PORT']) or die('Can\'t connect');
                     
mysql_select_db($database);

$result = mysql_query('SELECT startStation from formAnswers;');

print $result;
echo $result;
mysql_close();
 




?>