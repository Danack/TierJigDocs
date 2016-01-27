<?php


//Example noevents_basic
use Tier\TierHTTPApp;

// Create the Tier application
$app = new TierHTTPApp($injectionParams);

$app->addBeforeGenerateBodyExecutable(['Security', 'checkUserAllowed']);
$app->addGenerateBodyExecutable(['Router', 'routeRequest']);

//Example end

ob_end_clean();

