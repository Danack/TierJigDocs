<?php

namespace ScriptHelper\ScriptInclude;

use ScriptHelper\CSSFile;
use ScriptHelper\ScriptInclude;
use ScriptHelper\ScriptURLGenerator;


class ScriptIncludePacked extends AbstractScriptInclude
{
    private $scriptURLGenerator;
    
    public function __construct(
        ScriptURLGenerator $scriptURLGenerator
    ) {
        $this->scriptURLGenerator = $scriptURLGenerator;
    }

    public function renderJSLinks()
    {
        if (count($this->includeJSArray) == 0) {
            return "";
        }

        $url = $this->scriptURLGenerator->arrayJSFiles($this->includeJSArray);
 
        return sprintf(
            "<script type='text/javascript' src='%s'></script>",
            $url
        );
    }

    /**
     * @param $media
     * @param $cssList CSSFile[]
     * @return string
     */
    private function renderMediaCSS($mediaQuery, $cssList)
    {
        $mediaString = '';

        if ($mediaQuery) {
            $mediaString = " media='".$mediaQuery."' ";
        }

        $url = $this->scriptURLGenerator->arrayCSSFiles($cssList);
        
        $output = sprintf(
            "<link rel='stylesheet' type='text/css' %s href='%s' />\n",
            $mediaString,
            $url
        );

        return $output;
    }

    /**
     * @return string
     */
    public function renderCSSLinks()
    {
        if (count($this->cssFiles) == 0) {
            return "";
        }

        $mediaCSS = [];

        foreach ($this->cssFiles as $cssFile) {
            $mediaCSS[$cssFile->getMediaQuery()][] = $cssFile;
        }
        
        $output = "";

        foreach ($mediaCSS as $media => $cssList) {
            $output .= $this->renderMediaCSS($media, $cssList);
        }

        return $output;
    }
}
