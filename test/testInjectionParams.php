<?php

use Tier\InjectionParams;

// These classes will only be created once by the injector.
$shares = [
//    'Jig\JigRender',
//    'Jig\Jig',
//    'Jig\JigConverter',
//    'ScriptHelper\ScriptInclude',
//    'ScriptHelper\ScriptVersion',
//    'Room11\HTTP\HeadersSet',
//    new \FileFilter\YuiCompressorPath("/usr/lib/yuicompressor.jar"),
//    new \Tier\Path\AutogenPath( __DIR__.'/../autogen/'),
//    new \Tier\Path\CachePath(__DIR__.'/../var/cache/'),
//    new \Tier\Path\ExternalLibPath(__DIR__.'/../lib/'),
//    new \Tier\Path\WebRootPath(__DIR__.'/../public/'),
];

// Alias interfaces (or classes) to the actual types that should be used 
// where they are required. 
$aliases = [
//    'Room11\HTTP\Request' => 'Room11\HTTP\Request\Request',
//    'Room11\HTTP\Response' => 'Room11\HTTP\Response\Response',
//    'ScriptHelper\FilePacker' => 'ScriptHelper\FilePacker\YuiFilePacker',
//    'ScriptHelper\ScriptURLGenerator' => 'ScriptHelper\ScriptURLGenerator\StandardScriptURLGenerator',
//    'ScriptHelper\ScriptVersion' => 'ScriptHelper\ScriptVersion\DateScriptVersion',
//    'Tier\VariableMap\VariableMap' => 'Tier\VariableMap\RequestVariableMap',
    'Jig\Escaper' => 'Jig\Bridge\ZendEscaperBridge'
];

// Delegate the creation of types to callables.
$delegates = [
    //'Room11\Caching\LastModifiedStrategy' => 'createCaching',
    //'ScriptHelper\ScriptInclude' => 'createScriptInclude',
    'JigDocs\Model\UserInfo' => 'createUserInfo'
];

// If necessary, define some params that can be injected purely by name.
$params = [];

$prepares = [
    //'Jig\Jig' =>  'prepareJig',
];

$injectionParams = new InjectionParams(
    $shares,
    $aliases,
    $delegates,
    $params,
    $prepares
);

return $injectionParams;
