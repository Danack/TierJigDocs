<?php

use Jig\JigConfig;
use Jig\Jig;
use Room11\HTTP\Request;
use Room11\HTTP\Response;
use Room11\HTTP\Body\TextBody;
use Tier\InjectionParams;
use Site\Config;
use ScriptHelper\ScriptVersion;
use FastRoute\Dispatcher;
use Tier\Executable;
use Tier\JigBridge\TierJig;

/**
 * @return JigConfig
 */
function createJigConfigForJigDocs(Config $config)
{
    $jigConfig = new JigConfig(
        __DIR__."/../templatesJig/",
        __DIR__."/../var/compilejig/",
        $config->getKey(Config::JIG_COMPILE_CHECK),
        'tpl'
    );

    return $jigConfig;
}


function createJigConfigForTierDocs(Config $config)
{
    $jigConfig = new JigConfig(
        __DIR__."/../templatesTier/",
        __DIR__."/../var/compiletier/",
        $config->getKey(Config::JIG_COMPILE_CHECK),
        'tpl'
    );

    return $jigConfig;
}

function jigRoutesFunction(\FastRoute\RouteCollector $r)
{
    $r->addRoute('GET', "/css/{commaSeparatedFilenames}", ['ScriptHelper\Controller\ScriptServer', 'serveCSS']);
    $r->addRoute('GET', '/js/{commaSeparatedFilenames}', ['ScriptHelper\Controller\ScriptServer', 'serveJavascript']);
    $r->addRoute('GET', '/debug', ['JigDocs\Controller\Index', 'debug']);
}

function tierRoutesFunction(\FastRoute\RouteCollector $r)
{
    $r->addRoute('GET', "/css/{commaSeparatedFilenames}", ['ScriptHelper\Controller\ScriptServer', 'serveCSS']);
    $r->addRoute('GET', '/js/{commaSeparatedFilenames}', ['ScriptHelper\Controller\ScriptServer', 'serveJavascript']);
    $r->addRoute('GET', '/', ['TierDocs\Controller\Index', 'renderIndexPage']);
    $r->addRoute('GET', '/executing', ['TierDocs\Controller\Index', 'renderExecutingPage']);
    $r->addRoute('GET', '/dic', ['TierDocs\Controller\Index', 'renderDicPage']);
    $r->addRoute('GET', '/executionControl', ['TierDocs\Controller\Index', 'renderExecutionControlPage']);    
    $r->addRoute('GET', '/examples', ['TierDocs\Controller\Index', 'renderExamplesPage']);
    $r->addRoute('GET', '/examples/caching', ['TierDocs\Controller\Index', 'renderCachingPage']);
    $r->addRoute('GET', '/examples/configuration', ['TierDocs\Controller\Index', 'renderConfigurationPage']);
    $r->addRoute('GET', '/examples/contexts', ['TierDocs\Controller\Index', 'renderContextsPage']);
}



function getExampleClassnameFromTemplate($exampleName)
{
    $classname = str_replace('/', '', $exampleName);

    $classname = sprintf(
        'JigDocs\Data\Examples\\%sOutput',
        $classname
    );

    return $classname;
}

function getTierExampleClassnameFromExampleName($exampleName)
{
    $classname = str_replace('/', '', $exampleName);

    $classname = sprintf(
        'TierDocs\Data\Examples\\%sOutput',
        $classname
    );

    return $classname;
}

function renderTemplates($templates)
{
    $path = __DIR__."/../test/fixtures/example_templates/";
    $dirPath = realpath($path);
    
    $output = '';
    foreach ($templates as $template) {
        $templatePath = $dirPath.'/'.$template.'.php.tpl';
        $output .= "<pre>";
        $string = file_get_contents($templatePath);
        $string = htmlentities($string, ENT_DISALLOWED | ENT_HTML401 | ENT_NOQUOTES, 'UTF-8');
        $output .= $string;
        $output .= "</pre>";
    }

    echo $output;
}




function prepareJig(Jig $jig, $injector)
{
    $jig->addDefaultPlugin('JigDocs\Plugin\SitePlugin');
    
    $jig->bindCompileBlock(
        'renderOutputFile',
        ['Site\CodeHighlighter', 'renderOutputFileStart'],
        ['Site\CodeHighlighter', 'renderOutputFileEnd']
    );

    $jig->bindCompileBlock(
        'renderTemplateFile',
        ['Site\CodeHighlighter', 'renderTemplateFileStart'],
        ['Site\CodeHighlighter', 'renderTemplateFileEnd']
    );
    
    $jig->bindCompileBlock(
        'renderExampleCode',
        ['Site\CodeHighlighter', 'renderExampleCodeStart'],
        ['Site\CodeHighlighter', 'renderExampleCodeEnd']
    );
    
//    $jig->bindCompileBlock(
//        'highlightCode',
//        ['Site\CodeHighlighter', 'highlightCodeStart'],
//        ['Site\CodeHighlighter', 'highlightCodeEnd']
//    );
}

function createJigDispatcher(Config $config)
{
    $dispatcher = \FastRoute\cachedDispatcher(
        'jigRoutesFunction',
        array(
            'cacheFile' => __DIR__.'/../var/cache/route.cache',
            'cacheDisabled' => !$config->getKey(Config::ROUTE_CACHING),
        )
    );

    return $dispatcher;
}

function createTierDispatcher(Config $config)
{
    $dispatcher = \FastRoute\cachedDispatcher(
        'tierRoutesFunction',
        array(
            'cacheFile' => __DIR__.'/../var/cache/route.cache',
            'cacheDisabled' => !$config->getKey(Config::ROUTE_CACHING),
        )
    );

    return $dispatcher;
}

function createCaching()
{
    return new \Room11\Caching\LastModified\Revalidate(3600, 1200);
}

function createScriptInclude(
    Config $config,
    \ScriptHelper\ScriptURLGenerator $scriptURLGenerator
) {
    $packScript = $config->getKey(Config::SCRIPT_PACKING);
//    $packScript = true;
    if ($packScript) {
        return new \ScriptHelper\ScriptInclude\ScriptIncludePacked($scriptURLGenerator);
    }
    else {
        return new \ScriptHelper\ScriptInclude\ScriptIncludeIndividual($scriptURLGenerator);
    }
}

function createUserInfo()
{
    return new \JigDocs\Model\UserInfo("Danack", "MrDanack");
}

function createDispatcher()
{
    $dispatcher = FastRoute\simpleDispatcher('routesFunction');
    
    return $dispatcher;
}
