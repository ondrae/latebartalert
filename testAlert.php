<?php
include sendAlerts.php;
$currentAdvisory = 'Testing testing.';
sendAlerts($currentAdvisory, ['4153074175']); // Send every alert to me.
?>