<?php

use Tier\InjectionParams;

// These classes will only be created once by the injector.
$shares = [
    'Jig\JigRender',
    'Jig\Jig',
    'Jig\JigConverter',
    'ScriptHelper\ScriptInclude',
    'ScriptHelper\ScriptVersion',
    'Room11\HTTP\HeadersSet',
    new \FileFilter\YuiCompressorPath("/usr/lib/yuicompressor.jar"),
    new \JigDocs\RouteCachePath(__DIR__.'/../var/cache/'),
    new \JigDocs\TestFixturesPath(__DIR__."/../test/fixtures"),
    new \Tier\Path\AutogenPath( __DIR__.'/../autogen/'),
    new \Tier\Path\CachePath(__DIR__.'/../var/cache/'),
    new \Tier\Path\ExternalLibPath(__DIR__.'/../lib/'),
    new \Tier\Path\WebRootPath(__DIR__.'/../public/'),
    new \Jig\JigTemplatePath(__DIR__."/../templatesJig/"),
    new \Jig\JigCompilePath(__DIR__."/../var/compilejig/"),
];

// Alias interfaces (or classes) to the actual types that should be used 
// where they are required. 
$aliases = [
    'ScriptHelper\FilePacker' => 'ScriptHelper\FilePacker\YuiFilePacker',
    'ScriptHelper\ScriptURLGenerator' => 'ScriptHelper\ScriptURLGenerator\StandardScriptURLGenerator',
    'ScriptHelper\ScriptVersion' => 'ScriptHelper\ScriptVersion\DateScriptVersion',
    'Tier\VariableMap\VariableMap' => 'Tier\VariableMap\RequestVariableMap',
    'Jig\Escaper' => 'Jig\Bridge\ZendEscaperBridge',
    'Room11\HTTP\RequestHeaders' => 'Room11\HTTP\RequestHeaders\HTTPRequestHeaders',
    'Room11\HTTP\RequestRouting' => 'Room11\HTTP\RequestRouting\PSR7RequestRouting',
    'Room11\HTTP\VariableMap' => 'Room11\HTTP\VariableMap\PSR7VariableMap',
    'Zend\Diactoros\Response\EmitterInterface' => 'Zend\Diactoros\Response\SapiEmitter',
];

// Delegate the creation of types to callables.
$delegates = [
    'Room11\Caching\LastModifiedStrategy' => ['JigDocs\App', 'createCaching'],
    'ScriptHelper\ScriptInclude' => ['JigDocs\App','createScriptInclude'],
    'JigDocs\Model\UserInfo' => ['JigDocs\App','createUserInfo'],
    'FastRoute\Dispatcher' => ['JigDocs\App','createDispatcher',]
];

// If necessary, define some params that can be injected purely by name.
$params = [];

$prepares = [
    'Jig\Jig' =>  ['JigDocs\App', 'prepareJig'],
];

$injectionParams = new InjectionParams(
    $shares,
    $aliases,
    $delegates,
    $params,
    $prepares
);

return $injectionParams;
