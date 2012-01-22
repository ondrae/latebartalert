<?php
include 'sendAlerts.php';
$currentAdvisory = 'Testing testing.';
$to[] = '4153074175';
sendAlerts($currentAdvisory, $to); // Send every alert to me.
echo 'Yo.';
?>