<?php

# Tier handles all displaying of errors.
ini_set('display_errors', 'on');


use Tier\Tier;
use Tier\TierApp;
use Room11\HTTP\Request;
use Room11\HTTP\Body;
use Auryn\Injector;

use Room11\HTTP\Response\Response;

ini_set('display_errors', 'off');

require_once realpath(__DIR__).'/../vendor/autoload.php';

// Contains helper functions for the 'framework'.
require __DIR__."/../vendor/danack/tier/src/Tier/tierFunctions.php";

\Tier\setupErrorHandlers();

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

$response = new Response;
$injector->share($response);


// Create the Tier application

$app = new TierApp($injectionParams, $injector);

$body = null;

//$fn = function ($result) use ($body, $injector) {
//    if ($result instanceof Body) {
//        
//        $body = $result;
//        $injector->alias(Body::class, get_class($body));
//        $injector->share($body);
//        //Skip processing the rest of this stage.
//        return true;
//    }
//
//    return false;
//};
//

$app->addProduct('Room11\HTTP\Body');


//$app->setUserHandler($fn);
$app->addResponseCallable($tier);
//$app->addBeforeSendCallable('addSessionHeader');
//$app->addSendCallable('Tier\sendBodyResponse');

$fn = function () {
    echo "fin";
    return \Tier\TierApp::PROCESS_END;
};

$app->addSendCallable('Tier\sendBodyResponse');
//$app->addSendCallable($fn);

// The default exception handlers are good enough
$app->setStandardExceptionHandlers();



// Run it
$app->execute($request);
