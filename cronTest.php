#!/usr/bin/php
<?php
$myFile = "testFile.txt";
$fh = fopen($myFile, 'w');
$stringData = date("l")
fwrite($fh, $stringData);
fclose($fh);
?>