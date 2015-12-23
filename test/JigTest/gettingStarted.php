<?php

ob_start();

//Example gettingStarted_basic
use Auryn\Injector;
use Jig\JigConfig;
use Jig\Jig;

// Create a JigConfig object
$jigConfig = new JigConfig(
    //The directory the source templates are in
    __DIR__."/../fixtures/example_templates/",
    //The directory the generated PHP code will be written to.
    __DIR__."/../tmp/generatedTemplates/",
    // How to check if the templates need compiling.
    Jig::COMPILE_CHECK_MTIME,
    // The extension our templates will have.
    "php.tpl"
);

// Create a Jig renderer with our config
$jig = new Jig($jigConfig);

// Check the template is compiled to PHP and get the classname of the
// generated PHP template.
$className = $jig->compile("gettingStarted/basic");

// Create a DIC that can create an instance of the template
$injector = new Injector();

$injector->alias('Jig\Escaper', 'Jig\Bridge\ZendEscaperBridge');

// Create an instance of the template
$templateInstance = $injector->make($className);

// Render the template and send it to the user.
$output = $templateInstance->render();

// Send the output to the user
echo $output;

// Alternatively if your DIC supports direct execution 
//$output = $injector->execute([$className, 'render']);

//Example end

ob_end_clean();

return $output;