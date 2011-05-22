<?php
$db = mysql_connect("db.latebartalert.dotcloud.com:5293",
                     "root", "B.Hf+]79,sVi[{lfyy3!");
$result = mysql_query("SELECT 40+2");
$row = mysql_fetch_row($result);
$column = $row[0];
echo "SQL says 40 + 2 = ".$column;
?>
