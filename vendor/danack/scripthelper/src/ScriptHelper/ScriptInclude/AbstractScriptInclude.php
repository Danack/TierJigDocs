<?php

namespace ScriptHelper\ScriptInclude;

use ScriptHelper\ScriptInclude;
use ScriptHelper\CSSFile;

abstract class AbstractScriptInclude implements ScriptInclude
{
    protected $includeJSArray = array();

    /**
     * @var CSSFile[]
     */
    protected $cssFiles = [];

    private $onBodyLoadJavascript = array();


    abstract public function renderCSSLinks();
    abstract public function renderJSLinks();

    /**
     * @param $javascipt
     */
    public function addBodyLoadJS($javascipt)
    {
        $this->onBodyLoadJavascript[] = $javascipt;
    }

    /**
     * @param $cssFile
     * @param string $media
     */
    public function addCSSFile($cssFile, $media = 'screen')
    {
        $this->cssFiles[] = new CSSFile($cssFile, $media);
    }

    /**
     * @param $jsName
     */
    public function addJSFile($jsName)
    {
        $this->includeJSArray[] = $jsName;
    }

    /**
     * @return string
     */
    public function renderOnBodyLoadJavascript()
    {
        $output = "";
        $output .= "<script type='text/javascript'>";
        //$output .= "try {\n";

        foreach ($this->onBodyLoadJavascript as $functionToPerform) {
            $output .= $functionToPerform."\n";
        }

        //$output .= " }";
        $output .= "</script>";

        return $output;
    }
}
