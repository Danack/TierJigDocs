<?php

use Room11\HTTP\Request;
use Room11\HTTP\Body;
use Auryn\Injector;
use Room11\HTTP\Response\Response;
use Room11\HTTP\HeadersSet;
use Tier\TierHTTPApp;
use Tier\Executable;
use Room11\HTTP\Request\CLIRequest;

require_once realpath(__DIR__).'/../vendor/autoload.php';

// Contains helper functions for the 'framework'.
require __DIR__."/../vendor/danack/tier/src/Tier/tierFunctions.php";

\Tier\setupErrorHandlers();

# Tier handles all displaying of errors.
ini_set('display_errors', 'off');

require_once __DIR__."/../autogen/appEnv.php";

// Contains helper functions for the application.
require_once "appFunctions.php";

// Read application config params
$injectionParams = require_once "injectionParams.php";
$injectionParams->delegate('FastRoute\Dispatcher', 'createJigDispatcher');
$injectionParams->delegate('Jig\JigConfig', 'createJigConfigForJigDocs');

if (strcasecmp(PHP_SAPI, 'cli') == 0) {
    $request = new CLIRequest('/');
}
else {
    $request = \Tier\createRequestFromGlobals();
}

// Create the first Tier that needs to be run.
$executable = new Executable(
    ['Tier\JigBridge\Router', 'routeRequest'], 
    null,
    null,
    'Room11\HTTP\Body' //skip if this has already been produced
);

// Create the Tier application
$app = new TierHTTPApp($injectionParams);

// Make the body that is generated be shared by TierApp
$app->addExpectedProduct('Room11\HTTP\Body');

$app->addGenerateBodyExecutable($executable);
$app->addSendCallable('Tier\sendBodyResponse');

$app->createStandardExceptionResolver();

// Run it
$app->execute($request);

