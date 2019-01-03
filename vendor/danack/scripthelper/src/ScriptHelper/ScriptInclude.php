<?php


namespace ScriptHelper;

interface ScriptInclude
{
    public function addCSSFile($cssFile, $media = 'screen');
    public function renderCSSLinks();

    public function addJSFile($jsName);
    public function renderJSLinks();

    public function addBodyLoadJS($javascipt);
    public function renderOnBodyLoadJavascript();
}
