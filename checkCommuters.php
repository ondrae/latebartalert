<?php
function checkCommuters(){
	include 'sqlConnect.php';
		echo $date = date("Y-m-d H:i:s");
		echo "\n";
		$table = "formAnswers";
		openDatabase();
		$query="SELECT * FROM $table";
		$result=mysql_query($query);
		//$lastAdvisory = mysql_result($result, 0);
		//echo $lastAdvisory;
		mysql_close();
		//include sendAlerts();
		}
	}
} 

checkCommuters();
?>