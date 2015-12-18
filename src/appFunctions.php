<?php

use Jig\JigConfig;
use Jig\Jig;
use Jig\Converter\JigConverter;
use Room11\HTTP\Request;
use Room11\HTTP\Response;
use Room11\HTTP\Body\TextBody;
use Tier\InjectionParams;
use Tier\Tier;
use Site\Config;
use ScriptHelper\ScriptVersion;
use Predis\Client as RedisClient;
use FastRoute\Dispatcher;
use Room11\HTTP\HeadersSet;
use Tier\Executable;

/**
 * @return JigConfig
 */
function createJigConfigForJigDocs(Config $config)
{
    $jigConfig = new JigConfig(
        __DIR__."/../templatesJig/",
        __DIR__."/../var/compilejig/",
        'tpl',
        $config->getKey(Config::JIG_COMPILE_CHECK)
    );

    return $jigConfig;
}


function createJigConfigForTierDocs(Config $config)
{
    $jigConfig = new JigConfig(
        __DIR__."/../templatesTier/",
        __DIR__."/../var/compiletier/",
        'tpl',
        $config->getKey(Config::JIG_COMPILE_CHECK)
    );

    return $jigConfig;
}

function jigRoutesFunction(\FastRoute\RouteCollector $r)
{
    $r->addRoute('GET', "/css/{commaSeparatedFilenames}", ['ScriptHelper\Controller\ScriptServer', 'serveCSS']);
    $r->addRoute('GET', '/js/{commaSeparatedFilenames}', ['ScriptHelper\Controller\ScriptServer', 'serveJavascript']);
    $r->addRoute('GET', '/', ['JigDocs\Controller\Index', 'renderIndexPage']);
    $r->addRoute('GET', '/debug', ['JigDocs\Controller\Index', 'debug']);
    $r->addRoute('GET', '/syntax', ['JigDocs\Controller\Syntax', 'indexPage']);
    $r->addRoute('GET', '/syntax/{example:\w+}', ['JigDocs\Controller\Syntax', 'examplePage']);
    $r->addRoute('GET', '/extending', ['JigDocs\Controller\Extending', 'indexPage']);
    $r->addRoute('GET', '/extending/{example:\w+}', ['JigDocs\Controller\Extending', 'examplePage']);
    $r->addRoute('GET', '/onePage', ['JigDocs\Controller\Index', 'onePageExample']);
    $r->addRoute('GET', '/gettingStarted', ['JigDocs\Controller\Index', 'gettingStarted']);

    $r->addRoute('GET', '/testingTemplates', ['JigDocs\Controller\Index', 'testingTemplates']);
    $r->addRoute('GET', '/userSetting', ['JigDocs\Controller\UserSetting', 'updateSetting']);
    $r->addRoute('POST', '/userSetting', ['JigDocs\Controller\UserSetting', 'updateSetting']);
    $r->addRoute('POST', '/deploy/githook', ['JigDocs\Controller\GitWebHook', 'event']);
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

function serve404ErrorPage(Response $response)
{
    $response->setStatus(404);

    return new TextBody('Route not found.');
}

function serve405ErrorPage(Response $response)
{
    $response->setStatus(404);

    return new TextBody('Method not allowed for route.');
}

function routeRequest(Dispatcher $dispatcher, Request $request)
{
    $httpMethod = 'GET';
    $uri = '/';

    if (array_key_exists('REQUEST_URI', $_SERVER)) {
        $uri = $_SERVER['REQUEST_URI'];
    }

    // TODO - actually use $request
    $path = $uri;
    $queryPosition = strpos($path, '?');
    if ($queryPosition !== false) {
        $path = substr($path, 0, $queryPosition);
    }

    $routeInfo = $dispatcher->dispatch($httpMethod, $path);

    $dispatcherResult = $routeInfo[0];
    
    if ($dispatcherResult == \FastRoute\Dispatcher::FOUND) {
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $params = InjectionParams::fromParams($vars);

        return new Executable($handler, $params, null);
    }
    else if ($dispatcherResult == \FastRoute\Dispatcher::NOT_FOUND) {
        return new Executable('serve404ErrorPage');
    }

    //TODO - need to embed allowedMethods....theoretically.
    return new Executable('serve405ErrorPage');
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
        //$output .= "Template is: $template<br/>";
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
    
    $jig->bindCompileBlock(
        'highlightCode',
        ['Site\CodeHighlighter', 'highlightCodeStart'],
        ['Site\CodeHighlighter', 'highlightCodeEnd']
    );
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
    $packScript = true;
    if ($packScript) {
        return new \ScriptHelper\ScriptInclude\ScriptIncludePacked($scriptURLGenerator);
    }
    else {
        return new \ScriptHelper\ScriptInclude\ScriptIncludeIndividual($scriptURLGenerator);
    }
}

function createRedisClient()
{
    $redisParameters = array(
        "scheme" => "tcp",
        "host" => '127.0.0.1',
        "port" => 6379
    );

    $redisOptions = array(
        'profile' => '2.6'
    );

    $redisClient = new RedisClient($redisParameters, $redisOptions);

    return $redisClient;
}