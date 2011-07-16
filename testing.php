<?php

$envjson = json_decode(file_get_contents("/home/dotcloud/environment.json"),true);

#Create MySQL Connection
$db = mysql_connect($envjson['DOTCLOUD_DB_MYSQL_HOST']
					.':'.$envjson['DOTCLOUD_DB_MYSQL_PORT'],
					$envjson['DOTCLOUD_DB_MYSQL_LOGIN'],
					$envjson['DOTCLOUD_DB_MYSQL_PASSWORD']);
$result = mysql_query("SELECT 40+2");
$row = mysql_fetch_row($result);
$column = $row[0];
echo "SQL says 40 + 2 = ".$column;
?>

