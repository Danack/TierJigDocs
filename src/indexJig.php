<?php


use Tier\Tier;
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

//// Read application config params
//$injectionParams = require_once "injectionParams.php";
//
//// Create the first Tier that needs to be run.
//$tier = new TierHTTPApp('routeRequest');

//
//// Create the first Tier that needs to be run.
//$executable = new Executable('routeRequest', null, null, 'Room11\HTTP\Body');
//
//$request = \Tier\createRequestFromGlobals();
//
//$injector = new Injector();
//$injector->share($request);
//$injector->alias(Request::class, get_class($request));
//
////These are site specific

// 
//
//
////$responseHeaders = new HeadersSet;
////$injector->share($responseHeaders);
//
//
//// Create the Tier application
//$app = new TierHTTPApp($injectionParams, $injector);
//
//// The default exception handlers are good enough
//$app->setStandardExceptionHandlers();
//
//$app->addExpectedProduct('Room11\HTTP\Body');
//
//$app->addResponseCallable($tier);
//$app->addBeforeSendCallable('addSessionHeader');
//$app->addSendCallable('Tier\sendBodyResponse');
//
//// Run it
//$app->execute($request);



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
$executable = new Executable('routeRequest', null, null, 'Room11\HTTP\Body');

// Create the Tier application
$app = new TierHTTPApp($injectionParams);

// Make the body that is generated be shared by TierApp
$app->addExpectedProduct('Room11\HTTP\Body');

// Check to see if a form has been submitted, and we need to do 
// a POST/GET redirect
//$app->addPreCallable(['FCForms\HTTP', 'processFormRedirect']);

$app->addGenerateBodyExecutable($executable);
//$app->addBeforeSendCallable('addSessionHeader');
$app->addSendCallable('Tier\sendBodyResponse');

$app->createStandardExceptionResolver();

// Run it
$app->execute($request);

