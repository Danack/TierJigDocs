<?php

namespace JigTest;

use Jig\Jig;
use Jig\Converter\JigConverter;
use Jig\JigConfig;
use Mockery;

/**
 * Class ExampleTest
 * @package JigTest
 *
 * These technically aren't unit tests. Instead they are a hack to allow some
 * output to be generated easily.
 */
class ExampleTest extends BaseTestCase
{
    /**
     * @var \Jig\JigDispatcher
     */
    private $jig;

    private $jigRender;
    
    /** @var  \Auryn\Injector */
    private $injector;
    
    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $templateDirectory = dirname(__DIR__)."/./fixtures/example_templates/";
        $compileDirectory = dirname(__DIR__)."/./../tmp/generatedTemplates/";

        $jigConfig = new JigConfig(
            $templateDirectory,
            $compileDirectory,
            "php.tpl",
            Jig::COMPILE_ALWAYS
        );

        $injector = new \Auryn\Injector();
        $injector->share($jigConfig);
        $injector->share($injector);
        
        $this->injector = $injector;

        $jigConverter = new JigConverter($jigConfig);
        $jigConverter->addDefaultPlugin('TierJig\Plugin\SitePlugin');
        
        $this->jig = new \Jig\JigDispatcher($jigConfig, $injector, $this->jigRender);
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
//            ['extending/blocks'],
//            ['extending/builtinFilters'],
//            ['extending/compileBlocks'],
            ['extending/filters'],
            ['extending/functions'],
        ];
    }
    /**
     * @dataProvider provider
     * @throws \Exception
     * @throws \Jig\JigException
     */
    public function testIncludeExample($template)
    {
        $contents = $this->jig->renderTemplateFile($template.'/index');
        $this->saveExampleOutput($template, $contents);
    }

    /**
     * @group DEBUGGING
     */
    public function testExtendingFilter()
    {
        $contents = $this->jig->renderTemplateFile('extending/filters/index');
        $this->saveExampleOutput('extending/filters', $contents);
    }


    public function testUnitTesting()
    {
//Example unitTesting_basic
        $contactUsMock = Mockery::mock('JigDocs\Model\ContactUs');
        $contactUsMock
            ->shouldReceive('render')
            ->atLeast()->times(1) //checks render is called at least once
            ->andReturn("This is a mock contact us string");
        $this->injector->alias('JigDocs\Model\ContactUs', get_class($contactUsMock));
        $this->injector->share($contactUsMock);
        
        $obj = $this->injector->make('JigDocs\Model\ContactUs');        
        $contents = $this->jig->renderTemplateFile('unitTesting/basic/correct');
//Example end
        $this->saveExampleOutput('unitTesting/basic', $contents);
    }

    public function testUnitTestingFailCase()
    {
        $contactUsMock = Mockery::mock('TierJig\Model\ContactUs');
        $contactUsMock
            ->shouldReceive('render')//checks render is called at least once
            ->andReturn("Foo");
        $this->injector->alias('TierJig\Model\ContactUs', get_class($contactUsMock));
        $this->injector->share($contactUsMock);
        $contents = $this->jig->renderTemplateFile('unitTesting/basic/error');
    }
    
    
    
//    public function testCompileTimeBlock()
//    {
//        $templateDirectory = dirname(__DIR__)."/./fixtures/example_templates/";
//        $compileDirectory = dirname(__DIR__)."/./../tmp/generatedTemplates/";
//
//        $injector = new \Auryn\Injector();
//        
//        $jigConfig = new JigConfig(
//            $templateDirectory,
//            $compileDirectory,
//            "php.tpl",
//            Jig::COMPILE_ALWAYS
//        );
//
////Example extending_compileTimeBlocks
//        $injector = new \Auryn\Injector();
//        $jigConverter = new JigConverter($jigConfig);
//        $jigRender = new JigRender($jigConfig, $jigConverter);
//        
//        $blockStartFn = function(JigConverter $jigConverter, $extraText) {
//            $jigConverter->addText("This is the block start");
//        };
//
//        $blockEndFn = function(JigConverter $jigConverter, $extraText, $blockText) {
//            $jigConverter->addText("This is the block start");
//        };
//        
//        $jigConverter->bindCompileBlock(
//            'replaceCompileTime',
//            $blockStartFn,
//            $blockEndFn
//        );
//
//        $jigRender->checkTemplateCompiled('extending/compileTimeBlocks/index');
//        $className = $jigConfig->getFullClassname('extending/compileTimeBlocks/index');
//        $contents = $injector->execute([$className, 'render']);
////Example end
//
//        $this->saveExampleOutput('extending/compileTimeBlocks/index', $contents);
//    }
//    

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




