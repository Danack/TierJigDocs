<?php


use Tier\Tier;
use Room11\HTTP\Request;
use Room11\HTTP\Body;
use Auryn\Injector;
use Room11\HTTP\Response\Response;
use Room11\HTTP\HeadersSet;
use Tier\TierHTTPApp;

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

// Create the first Tier that needs to be run.
$tier = new Tier('routeRequest');


$request = \Tier\createRequestFromGlobals();

$injector = new Injector();
$injector->share($request);
$injector->alias(Request::class, get_class($request));

//These are site specific
$injector->delegate('FastRoute\Dispatcher', 'createTierDispatcher');
$injector->delegate('Jig\JigConfig', 'createJigConfigForTierDocs');

//$responseHeaders = new HeadersSet;
//$injector->share($responseHeaders);

// Create the Tier application
$app = new TierHTTPApp($injectionParams, $injector);

// The default exception handlers are good enough
$app->setStandardExceptionHandlers();

$app->addExpectedProduct('Room11\HTTP\Body');

$app->addResponseCallable($tier);
$app->addBeforeSendCallable('addSessionHeader');
$app->addSendCallable('Tier\sendBodyResponse');

// Run it
$app->execute($request);
