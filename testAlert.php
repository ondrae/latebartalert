<?php
include sendAlerts.php;
$currentAdvisory = 'Testing testing.';
sendAlerts($currentAdvisory, list('4153074175')); // Send every alert to me.
?>