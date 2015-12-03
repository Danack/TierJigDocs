<?php

use Tier\InjectionParams;

// These classes will only be created once by the injector.
$shares = [
    'Jig\JigRender',
    'Jig\Jig',
    'Jig\JigConverter',
    'Intahwebz\Session',
    'ScriptServer\Service\ScriptInclude',
    'ASM\Session',
    'Room11\HTTP\HeadersSet'
];


// Alias interfaces (or classes) to the actual types that should be used 
// where they are required. 
$aliases = [
    'Room11\HTTP\Request' => 'Room11\HTTP\Request\Request',
    'Room11\HTTP\Response' => 'Room11\HTTP\Response\Response',
    'Tier\VariableMap\VariableMap' => 'Tier\VariableMap\RequestVariableMap',
    //'Intahwebz\Session' => 'Intahwebz\Session\Session',
];

// Delegate the creation of types to callables.
$delegates = [
    'Predis\Client' => 'createRedisClient',
    //'Jig\JigConfig' => 'createJigConfig',
    //'FastRoute\Dispatcher' => 'createDispatcher',
    'ScriptServer\Service\ScriptInclude' => 'createScriptInclude',
    //'ASM\SessionManager' => 'createSession',
    'ASM\Session' => 'createSession',
];

// If necessary, define some params that can be injected purely by name.
$params = [];

$prepares = [
    'Jig\Jig' =>  'prepareJig',
];

$injectionParams = new InjectionParams(
    $shares,
    $aliases,
    $delegates,
    $params,
    $prepares
);

return $injectionParams;
