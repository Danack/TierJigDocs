<?php

namespace TierDocs;

use Jig\JigConfig;
use Jig\Jig;
use Room11\HTTP\Request;
use Room11\HTTP\Response;
use Tier\InjectionParams;
use Site\Config;
use ScriptHelper\ScriptVersion;
use FastRoute\Dispatcher;
use Tier\Executable;
use Tier\JigBridge\TierJig;
use Jig\JigTemplatePath;
use Jig\JigCompilePath;


class App
{
    public static function createJigConfigForTierDocs(
        Config $config,
        JigTemplatePath $jigTemplatePath,
        JigCompilePath $jigCompilePath
    ) {
        $jigConfig = new JigConfig(
            $jigTemplatePath,
            $jigCompilePath,
            $config->getKey(Config::JIG_COMPILE_CHECK),
            'tpl'
        );

        return $jigConfig;
    }

    public static function tierRoutesFunction(\FastRoute\RouteCollector $r)
    {
        $r->addRoute('GET', "/css/{commaSeparatedFilenames}", ['ScriptHelper\Controller\ScriptServer', 'serveCSS']);
        $r->addRoute('GET',
            '/js/{commaSeparatedFilenames}',
            ['ScriptHelper\Controller\ScriptServer', 'serveJavascript']
        );
        $r->addRoute('GET', '/', ['TierDocs\Controller\Index', 'renderIndexPage']);
        $r->addRoute('GET', '/executing', ['TierDocs\Controller\Index', 'renderExecutingPage']);
        $r->addRoute('GET', '/dic', ['TierDocs\Controller\Index', 'renderDicPage']);
        $r->addRoute('GET', '/executionControl', ['TierDocs\Controller\Index', 'renderExecutionControlPage']);
        $r->addRoute('GET', '/examples', ['TierDocs\Controller\Index', 'renderExamplesPage']);
        $r->addRoute('GET', '/examples/caching', ['TierDocs\Controller\Index', 'renderCachingPage']);
        $r->addRoute('GET', '/examples/configuration', ['TierDocs\Controller\Index', 'renderConfigurationPage']);
        $r->addRoute('GET', '/examples/contexts', ['TierDocs\Controller\Index', 'renderContextsPage']);
    }


    public static function getExampleClassnameFromTemplate($exampleName)
    {
        $classname = str_replace('/', '', $exampleName);

        $classname = sprintf(
            'JigDocs\Data\Examples\\%sOutput',
            $classname
        );

        return $classname;
    }

    public static function getTierExampleClassnameFromExampleName($exampleName)
    {
        $classname = str_replace('/', '', $exampleName);

        $classname = sprintf(
            'TierDocs\Data\Examples\\%sOutput',
            $classname
        );

        return $classname;
    }

    public static function renderTemplates(
        $templates,
        \JigDocs\TestFixturesPath $testFixturesPath
    ) {
        $path = $testFixturesPath->getPath();
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


    public static function prepareJig(Jig $jig, $injector)
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
    }

    public static function createTierDispatcher(
        Config $config,
        \TierDocs\RouteCachePath $routeCachePath
    ) {
        $dispatcher = \FastRoute\cachedDispatcher(
            ['TierDocs\App', 'tierRoutesFunction'],
            array(
                'cacheFile' => $routeCachePath->getPath().'/tier_route.cache',
                'cacheDisabled' => !$config->getKey(Config::ROUTE_CACHING),
            )
        );

        return $dispatcher;
    }

    public static function createCaching()
    {
        return new \Room11\Caching\LastModified\Revalidate(3600, 1200);
    }

    public static function createScriptInclude(
        Config $config,
        \ScriptHelper\ScriptURLGenerator $scriptURLGenerator
    ) {
        $packScript = $config->getKey(Config::SCRIPT_PACKING);
        // $packScript = true;
        if ($packScript) {
            return new \ScriptHelper\ScriptInclude\ScriptIncludePacked($scriptURLGenerator);
        }
        else {
            return new \ScriptHelper\ScriptInclude\ScriptIncludeIndividual($scriptURLGenerator);
        }
    }

    public static function createUserInfo()
    {
        return new \JigDocs\Model\UserInfo("Danack", "MrDanack");
    }

    public static function createDispatcher()
    {
        $dispatcher = \FastRoute\simpleDispatcher('routesFunction');

        return $dispatcher;
    }
}