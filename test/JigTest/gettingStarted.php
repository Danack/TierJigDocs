<?php

//Example gettingStarted_basic
use Auryn\Injector;
use Jig\JigConfig;
use Jig\Jig;


// Create a config object so we can 
$jigConfig = new JigConfig(
    //The directory the source templates are in
    __DIR__."/../fixtures/example_templates/",
    //The directory the generated PHP code will be written to.
    __DIR__."/../tmp/generatedTemplates/",
    // How to check if the templates need compiling. In this case
    // compared the source template last modified time, with the generated 
    // PHP file.
    Jig::COMPILE_CHECK_MTIME,
    // The extension our templates will have.
    "php.tpl"
);

// Create a Jig renderer with our config
$jig = new Jig($jigConfig);

// Check the template is compiled to PHP and get the classname of the
// generated PHP template.
$className = $jig->compile("gettingStarted/basic");

// Create a injector that can create an instance of the template and
// then execute the render method. 
$injector = new Injector();
$output = $this->injector->execute([$className, 'render']);
//Example end


return $output;