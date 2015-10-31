<?php



$autoloader = require(__DIR__.'/../vendor/autoload.php');

require(__DIR__.'/../src/appFunctions.php');

$autoloader->add('JigTest', [realpath('./').'/test/']);
$autoloader->add(
    "Jig\\PHPCompiledTemplate",
    [realpath(realpath('./').'/tmp/generatedTemplates/')]
);
