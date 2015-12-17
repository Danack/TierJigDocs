

</body>

{inject name='scriptInclude' type='ScriptHelper\ScriptInclude'}

{$scriptInclude->addJSFile("jquery-1.11.0.min")}
{$scriptInclude->addJSFile("jquery-ui-1.10.0.custom.min")}
{$scriptInclude->addJSFile("bootstrap")}
{$scriptInclude->addJSFile("tierjig")}

{$scriptInclude->renderJSLinks() | nofilter}

{$scriptInclude->renderOnBodyLoadJavascript() | nofilter}


</html>