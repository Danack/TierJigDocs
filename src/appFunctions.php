<?php


use Jig\JigConfig;
use Jig\Jig;
use Jig\Converter\JigConverter;
use Room11\HTTP\Request;
use Room11\HTTP\Response;
use Room11\HTTP\Body\TextBody;
use Tier\InjectionParams;
use Tier\Tier;
use TierJig\Config;
use TierJig\TierJigException;
use ScriptServer\Value\ScriptVersion;
use Predis\Client as RedisClient;
use ASM\SessionConfig;
use ASM\SessionManager;
use ASM\Session;
use FastRoute\Dispatcher;

/**
 * @return JigConfig
 */
function createJigConfig(Config $config)
{
    $jigConfig = new JigConfig(
        __DIR__."/../templates/",
        __DIR__."/../var/compile/",
        'tpl',
        $config->getKey(Config::JIG_COMPILE_CHECK)
    );

    return $jigConfig;
}

function routesFunction(\FastRoute\RouteCollector $r)
{
    $r->addRoute('GET', '/', ['TierJig\Controller\Index', 'renderIndexPage']);
    
    $r->addRoute('GET', '/debug', ['TierJig\Controller\Index', 'debug']);
    
    $r->addRoute('GET', '/syntax', ['TierJig\Controller\Syntax', 'indexPage']);
    $r->addRoute('GET', '/syntax/{example:\w+}', ['TierJig\Controller\Syntax', 'examplePage']);

    $r->addRoute('GET', '/extending', ['TierJig\Controller\Extending', 'indexPage']);
    $r->addRoute('GET', '/extending/{example:\w+}', ['TierJig\Controller\Extending', 'examplePage']);
    
    $r->addRoute('GET', '/onePage', ['TierJig\Controller\Index', 'onePageExample']);
    $r->addRoute('GET', '/executing', ['TierJig\Controller\Index', 'executing']);
    $r->addRoute('GET', '/testingTemplates', ['TierJig\Controller\Index', 'testingTemplates']);
    
    
    

    $r->addRoute('GET', '/userSetting', ['TierJig\Controller\UserSetting', 'updateSetting']);
    $r->addRoute('POST', '/userSetting', ['TierJig\Controller\UserSetting', 'updateSetting']);
    
    
    
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

        return new Tier($handler, $params, null);
    }
    else if ($dispatcherResult == \FastRoute\Dispatcher::NOT_FOUND) {
        return new Tier('serve404ErrorPage');
    }

    //TODO - need to embed allowedMethods....theoretically.
    return new Tier('serve405ErrorPage');
}


function getExampleClassnameFromTemplate($exampleName)
{
    $classname = str_replace('/', '', $exampleName);

    $classname = sprintf(
        'TierJig\Data\Examples\\%sOutput',
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

function renderOutput($exampleName)
{
    $classname = getExampleClassnameFromTemplate($exampleName);

    if (class_exists($classname) == false) {
        throw new TierJigException("Class $classname is missing.");
    }

    $object = new $classname();

    $output = "Output:<br/>";
    $output .= "<pre>";
    $string = $object->renderOutput();
    $string = htmlentities($string, ENT_DISALLOWED | ENT_HTML401 | ENT_NOQUOTES, 'UTF-8');
    $output .= $string;
    $output .= "</pre>";
    
    echo $output;
}

function renderOutputFileStart(JigConverter $jigConverter, $extraText)
{
    $exampleName = trim($extraText);
    $classname = getExampleClassnameFromTemplate($exampleName);
    if (class_exists($classname) == false) {
        throw new TierJigException("Class $classname is missing.");
    }

    $object = new $classname();
    $output = "Output:<br/>";
    $output .= "<pre>";
    $string = $object->renderOutput();
    $string = htmlentities($string, ENT_DISALLOWED | ENT_HTML401 | ENT_NOQUOTES, 'UTF-8');
    $output .= $string;
    $output .= "</pre>";

    $jigConverter->addText($output);
}

function renderOutputFileEnd(JigConverter $jigConverter, $extraText)
{
    //$jigConverter->addHTML("renderOutputFileEnd: $extraText");
}

function renderTemplateFileStart(JigConverter $jigConverter, $extraText)
{
    $path = __DIR__."/../test/fixtures/example_templates/";
    $dirPath = realpath($path);
    $template = trim($extraText);
    $output = '';

    $templatePath = $dirPath.'/'.$template.'.php.tpl';
    $output .= "Template: $template<br/>";
    $output .= "<pre>";
    $string = file_get_contents($templatePath);
    $string = htmlentities($string, ENT_DISALLOWED | ENT_HTML401 | ENT_NOQUOTES, 'UTF-8');
    $output .= $string;
    $output .= "</pre>";

    $jigConverter->addText($output);
}

function renderTemplateFileEnd(JigConverter $jigConverter, $extraText)
{
    //$jigConverter->addHTML("renderTemplateFileEnd: $extraText");
}

function renderExampleCodeStart(JigConverter $jigConverter, $extraText)
{
    $filePattern = '#example=[\'"](.*)[\'"]#u';
    $valueMatchCount = preg_match($filePattern, $extraText, $valueMatches);
    if ($valueMatchCount == 0) {
        throw new TierJigException("Failed to get value for injection");
    }
    $filename = $valueMatches[1];
    $filename = str_replace('/', '_', $filename);
    $codeLines = getExampleCode($filename);

    if ($codeLines === false) {
        throw new TierJigException("Failed to read code from file $filename");
    }
    
    $code = implode("", $codeLines);
    $highLightedCode = \TierJig\Site\CodeHighlighter::highlight($code);
    $jigConverter->addText($highLightedCode);
}

function getExampleCode($exampleName)
{
    $startPattern = "//Example $exampleName";
    $endPattern = "//Example end";

    $srcDirectories = [
        __DIR__ . '/../test',
        __DIR__ . '/../lib',
        __DIR__ . '/../src',
    ];

    foreach ($srcDirectories as $srcDirectory) {
        $directory = new RecursiveDirectoryIterator($srcDirectory);
        $iterator = new RecursiveIteratorIterator($directory);
        $files = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::MATCH);
    
        foreach ($files as $file) {
            /** @var $file SplFileInfo */
            $filename = $file->getPath() . "/" . $file->getFilename();
    
            // open the file
            $fileLines = file($filename);
    
            if (!$fileLines) {
                throw new TierJigException("Failed to open $filename");
            }
    
            $firstLine = false;
            $lineCount = 0;
            $codeLines = false;
            $indent = '';
            foreach ($fileLines as $fileLine) {
                $lineCount++;
    
                if ($codeLines === false) {
                    $match = strpos($fileLine, $startPattern);
                    if ($match !== false) {
                        $codeLines = [];
                        $firstLine = true;
                        continue;
                    }
                }
                if ($codeLines !== false) {
                    $matches = null;
                    if ($firstLine == true) {
                        $matched = preg_match('#\s*#', $fileLine, $matches);
    
                        if ($matched) {
                            $indent = $matches[0];
                        }
                        $firstLine = false;
                    }
    
                    $endMatch = strpos($fileLine, $endPattern);
                    if ($endMatch !== false) {
                        return $codeLines;
                    }
                    
                    if ($indent) {
                        if (strpos($fileLine, $indent) === 0) {
                            $fileLine = substr($fileLine, strlen($indent));
                        }
                    }
    
                    $codeLines[] = $fileLine;
                }
            }
        }
    }

    return false;
}


function renderExampleCodeEnd(JigConverter $jigConverter, $extraText)
{
    //$jigConverter->addHTML("<br/>renderExampleCodeEnd: $extraText <br/>");
}





function highlightCodeStart(JigConverter $jigConverter, $extraText)
{
    //$jigConverter->addHTML("<pre>");
}

function highlightCodeEnd(JigConverter $jigConverter, $blockText)
{
    $text = \TierJig\Site\CodeHighlighter::highlight($blockText);
    $jigConverter->addText($text);
    //$jigConverter->addHTML("</pre>");
}


function prepareJig(Jig $jig, $injector)
{
    $jig->bindCompileBlock(
        'renderOutputFile',
        'renderOutputFileStart',
        'renderOutputFileEnd'
    );

    $jig->bindCompileBlock(
        'renderTemplateFile',
        'renderTemplateFileStart',
        'renderTemplateFileEnd'
    );
    
    $jig->bindCompileBlock(
        'renderExampleCode',
        'renderExampleCodeStart',
        'renderExampleCodeEnd'
    );
    
    $jig->bindCompileBlock(
        'highlightCode',
        'highlightCodeStart',
        'highlightCodeEnd'
    );
    
}

function createDispatcher(Config $config)
{
    $dispatcher = \FastRoute\cachedDispatcher(
        'routesFunction',
        array(
            'cacheFile' => __DIR__.'/../var/cache/route.cache',
            'cacheDisabled' => !$config->getKey(Config::ROUTE_CACHING),
        )
    );

    return $dispatcher;
}

function createScriptInclude(Config $config) //, ScriptVersion $scriptVersion)
{
    $scriptVersion = new ScriptVersion(123);
    
    $value = $config->getKey(Config::SCRIPT_PACKING);

    if ($value) {
        return new \ScriptServer\Service\ScriptIncludePacked($scriptVersion);
    }
        
    return new \ScriptServer\Service\ScriptIncludeIndividual(
        $scriptVersion
    );
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



function createSession(ASM\Redis\RedisDriver $redisDriver)
{
    $sessionConfig = new SessionConfig(
        'SessionTest',
        1000,
        10
    );

    $sessionManager = new SessionManager(
        $sessionConfig,
        $redisDriver
    );
    
    $session = $sessionManager->createSession($_COOKIE);

    return $session;
}


//Send these headers

//Rate-limiting:

//Vary:Accept-Encoding

//Session:
//Expires: (sometime in the future, according session.cache_expire)
//Cache-Control: public, max-age=(sometime in the future, according to session.cache_expire)

function addSessionHeader(Session $session, Response $response)
{
    $headers = $session->getHeaders(\ASM\SessionManager::CACHE_PRIVATE);

    foreach ($headers as $key => $value) {
        $response->addHeader($key, $value);
    }
}
