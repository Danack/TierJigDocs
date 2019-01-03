<?php

namespace ScriptHelper\ScriptInclude;

use ScriptHelper\ScriptInclude;
use ScriptHelper\ScriptURLGenerator;

class ScriptIncludeIndividual extends AbstractScriptInclude
{
    /**
     * @var ScriptURLGenerator
     */
    private $urlGenerator;
    
    public function __construct(ScriptURLGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }
    
    public function renderJSLinks()
    {
        $output = '';
        foreach ($this->includeJSArray as $includeJS) {
            $output .= sprintf(
                "<script type='text/javascript' src='%s'></script>\n",
                $this->urlGenerator->singleJSFile($includeJS)
            );
        }

        return $output;
    }

    
    /**
     * @return string
     */
    public function renderCSSLinks()
    {
        $output = "";

        foreach ($this->cssFiles as $cssFile) {
            $mediaString = '';

            if ($cssFile->mediaQuery) {
                $mediaString = " media='".$cssFile->mediaQuery."' ";
            }
    
            $output .= sprintf(
                "<link rel='stylesheet' type='text/css' %s href='%s' />\n",
                $mediaString,
                $this->urlGenerator->singleCSSFile($cssFile->file)
            );
        }

        return $output;
    }
}
