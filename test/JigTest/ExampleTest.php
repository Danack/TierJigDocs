<?php

namespace JigTest;

use Jig\Jig;
use Jig\Converter\JigConverter;
use Jig\JigConfig;
use Jig\JigDispatcher;
use Mockery;
use Jig\Bridge\ZendEscaperBridge;
use Zend\Escaper\Escaper as ZendEscaper;

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
    private $jigDispatcher;

    /** @var  \Auryn\Injector */
    private $injector;
    
    /**
     *
     */
    public function setUp()
    {
        parent::setUp();

        $injector = createTestInjector();;        
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
//            ['extending/blocks'],
//            ['extending/builtinFilters'],
//            ['extending/compileBlocks'],
            ['filters/builtin'],
            ['extending/blocks'],
            ['extending/filters'],
            ['extending/functions'],
            
            ['onepage/example'],
        ];
    }
    /**
     * @dataProvider provider
     * @throws \Exception
     * @throws \Jig\JigException
     */
    public function testIncludeExample($template)
    {
        $contents = $this->jigDispatcher->renderTemplateFile($template.'/index');
        $this->saveExampleOutput($template, $contents);
    }

    /**
     * @group DEBUGGING
     */
    public function testExtendingFilter()
    {
        $contents = $this->jigDispatcher->renderTemplateFile('extending/filters/index');
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
        $contents = $this->jigDispatcher->renderTemplateFile('unitTesting/basic/correct');
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
        $contents = $this->jigDispatcher->renderTemplateFile('unitTesting/basic/error');
    }
    
    
    
    public function testCompileTimeBlock()
    {
        $templateDirectory = dirname(__DIR__)."/./fixtures/example_templates/";
        $compileDirectory = dirname(__DIR__)."/./../tmp/generatedTemplates/";

        $jigConfig = new JigConfig(
            $templateDirectory,
            $compileDirectory,
            Jig::COMPILE_ALWAYS,
            "php.tpl"
        );

//Example extending_compileTimeBlocks
        $injector = new \Auryn\Injector();
        $escaper = new ZendEscaperBridge(new ZendEscaper());
        $injector->alias('Jig\Escaper', get_class($escaper));
        $injector->share($escaper);

        $jigConverter = new JigConverter($jigConfig);
        $jigRender = new Jig($jigConfig, $jigConverter);

        $blockStartFn = function(JigConverter $jigConverter, $extraText) {
            $jigConverter->addText("This is the block start");
            $jigConverter->addText("Extra text is $extraText");
        };

        $blockEndFn = function(JigConverter $jigConverter, $extraText) {
            
            
            $jigConverter->addText("This is the block end\n");
            $jigConverter->addText("Extra text is \"$extraText\"\n");
        };
        
        $jigConverter->bindCompileBlock(
            'replaceCompileTime',
            $blockStartFn,
            $blockEndFn
        );

        $jigRender->compile('extending/compileTimeBlocks/index');
        $className = $jigConfig->getFQCNFromTemplateName('extending/compileTimeBlocks/index');
        $contents = $injector->execute([$className, 'render']);
//Example end

        $this->saveExampleOutput('extending/compileTimeBlocks', $contents);
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
    
    public function testGettingStarted()
    {
        $contents = include __DIR__."/gettingStarted.php";
        $this->saveExampleOutput('gettingStarted/basic', $contents);
    }
    
}




