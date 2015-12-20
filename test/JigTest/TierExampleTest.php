<?php

namespace JigTest;

use Auryn\Injector;
use Jig\Jig;
use Jig\Converter\JigConverter;
use Jig\JigConfig;
use Mockery;
use JigTest\Foo;

/**
 * Class ExampleTest
 * @package JigTest
 *
 * These technically aren't unit tests. Instead they are a hack to allow some
 * output to be generated easily.
 */
class TierExampleTest extends BaseTestCase
{
    /**
     * @var \Jig\JigDispatcher
     */
    private $jigDispatcher;

    private $jigRender;
    
    /** @var  \Auryn\Injector */
    private $injector;
    
    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $injector = createTestInjector();
        $this->injector = $injector;
        $this->jigDispatcher = $this->injector->make('Jig\JigDispatcher');
    }


    public function provider()
    {
        return [
            ['syntax/basic'],
            ['syntax/ifelse'],
            ['syntax/foreachExample'],
            ['syntax/comments'],
            ['syntax/filters'],
            ['syntax/functions'],
            ['syntax/extending'],
            ['syntax/includeFile'],
            ['syntax/injecting'],
            ['syntax/literal'],

            ['extending/filters'],
            ['extending/functions'],
        ];
    }

    public function testInjectorSharing()
    {
        $injector = new Injector();
//Example injector_sharing
        $foo = new Foo();
        $foo->setValue("Initial object is shared.");
        $injector->share($foo);
        
        $fn = function (Foo $foo) {
            return $foo->getValue();
        };
        
        $contents = $injector->execute($fn);
//Example end
        $this->saveExampleOutput('injector/sharing', $contents);
    }

    private function saveExampleOutput($template, $contents)
    {
        $fileTemplate = file_get_contents(__DIR__."/outputClassTemplate.php.txt");
        
        $fqcn = \getExampleClassnameFromTemplate($template);
        
        $classContents = sprintf(
            $fileTemplate,
            getClassName($fqcn),
            $contents
        );

        $exampleFilename = sprintf(
            __DIR__."/../../lib/%s.php",
            $fqcn
        );
        $exampleFilename = str_replace('\\', '/', $exampleFilename);
        
        @mkdir(dirname($exampleFilename), 0777, true);
        file_put_contents($exampleFilename, $classContents);
    }
}



function getNamespace($namespaceClass)
{

    if (is_object($namespaceClass)) {
        $namespaceClass = get_class($namespaceClass);
    }

    $lastSlashPosition = mb_strrpos($namespaceClass, '\\');

    if ($lastSlashPosition !== false) {
        return mb_substr($namespaceClass, 0, $lastSlashPosition);
    }

    return "";
}


function getClassName($namespaceClass)
{
    $lastSlashPosition = mb_strrpos($namespaceClass, '\\');

    if ($lastSlashPosition !== false) {
        return mb_substr($namespaceClass, $lastSlashPosition + 1);
    }

    return $namespaceClass;
}
