<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Tier - because you don't need a framework</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {inject name='scriptInclude' type='ScriptHelper\ScriptInclude'}
    
    {$scriptInclude->addCSSFile("bootstrap_cyborg")}
    {$scriptInclude->addCSSFile("bootswatch_cyborg")}
    {$scriptInclude->addCSSFile("code_highlight_danack")}
    {$scriptInclude->addCSSFile("custom")}
    
    {$scriptInclude->renderCSSLinks() | nofilter}
    
</head>

<body>
