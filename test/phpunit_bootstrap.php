<?php

use Auryn\Injector;
use Jig\JigConfig;
use Jig\Jig;
use Jig\JigTemplatePath;
use Jig\JigCompilePath;

$autoloader = require(__DIR__.'/../vendor/autoload.php');

require(__DIR__.'/../src/appFunctions.php');

$autoloader->add('JigTest', [realpath('./').'/test/']);
$autoloader->add(
    "Jig\\PHPCompiledTemplate",
    [realpath(realpath('./').'/tmp/generatedTemplates/')]
);

function createTestInjector()
{
    $injector = new Injector();

    static $injectionParams = null;
    if ($injectionParams == null) {
        $injectionParams = require_once __DIR__."/testInjectionParams.php";
    }
    
    $injectionParams->addToInjector($injector);
    
    $templatePath = new JigTemplatePath(__DIR__."/./fixtures/example_templates/");
    $compilePath = new JigCompilePath(__DIR__."/./tmp/generatedTemplates/");

    $jigConfig = new JigConfig(
        $templatePath,
        $compilePath,
        Jig::COMPILE_ALWAYS,
        "php.tpl"
    );

    $injector->share($jigConfig);
    $injector->share($injector);
    
    return $injector;
}