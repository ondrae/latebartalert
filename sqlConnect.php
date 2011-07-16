<?php
#BART API KEY
$apiKey = 'EHDB-ZWQN-EKXT-VV5D';

openDatabase(){
	$envjson = json_decode(file_get_contents("/home/dotcloud/environment.json"),true);
	#Create MySQL Connection
	$db = mysql_connect($envjson['DOTCLOUD_DB_MYSQL_HOST']
						.':'.$envjson['DOTCLOUD_DB_MYSQL_PORT'],
						$envjson['DOTCLOUD_DB_MYSQL_LOGIN'],
						$envjson['DOTCLOUD_DB_MYSQL_PASSWORD']);
}
?>