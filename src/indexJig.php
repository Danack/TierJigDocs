<?php

use Room11\HTTP\Request;
use Room11\HTTP\Body;
use Tier\Tier;
use Tier\TierHTTPApp;
use Tier\Executable;
use Room11\HTTP\Request\CLIRequest;

require_once realpath(__DIR__).'/../vendor/autoload.php';

//// Contains helper functions for the 'framework'.
//require __DIR__."/../vendor/danack/tier/src/Tier/tierFunctions.php";

Tier::setupErrorHandlers();

# Tier handles all displaying of errors.
ini_set('display_errors', 'off');

$appEnvIncluded = require_once __DIR__."/../autogen/appEnv.php";

// Read application config params
$injectionParams = require_once "injectionParams.php";
$injectionParams->delegate('FastRoute\Dispatcher', ['JigDocs\App', 'createJigDispatcher']);
$injectionParams->delegate('Jig\JigConfig', ['JigDocs\App', 'createJigConfigForJigDocs']);


if (strcasecmp(PHP_SAPI, 'cli') == 0) {
    $request = new CLIRequest('/', 'phpjig.com');
}
else {
    $request = Tier::createRequestFromGlobals();
}

// Create the first Tier that needs to be run.
$executable = new Executable(['Tier\JigBridge\JigRouter', 'routeRequest']);

// Create the Tier application
$app = new TierHTTPApp($injectionParams);

// Make the body that is generated be shared by TierApp
$app->addExpectedProduct('Room11\HTTP\Body');

$app->addGenerateBodyExecutable($executable);
$app->addSendExecutable(['Tier\Tier', 'sendBodyResponse']);

$app->createStandardExceptionResolver();

// Run it
$app->execute($request);

