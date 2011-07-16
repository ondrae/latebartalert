<?php

$envjson = json_decode(file_get_contents("/home/dotcloud/environment.json"),true);

# Create MySQL Connection
$mysqli = new mysqli($envjson['DOTCLOUD_DB_MYSQL_HOST'],
                     $envjson['DOTCLOUD_DB_MYSQL_LOGIN'],         # username
                     $envjson['DOTCLOUD_DB_MYSQL_HOST'],   # password
                     'latebart',       # db name
                     $envjson['DOTCLOUD_DB_MYSQL_PORT']);

echo $mysqli->query('SELECT * from formAnswers;');

?>