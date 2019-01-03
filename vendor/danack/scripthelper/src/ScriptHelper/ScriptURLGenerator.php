<?php

namespace ScriptHelper;

interface ScriptURLGenerator
{
    public function arrayCSSFiles($cssList);
    public function arrayJSFiles($includeJSArray);
    
    public function singleCSSFile($cssName);
    public function singleJSFile($jsFilename);
}
