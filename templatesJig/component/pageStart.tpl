<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Jig - a DI based templating library</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel='stylesheet' type='text/css' href='/css/bootstrap.min.css' />
    <link rel='stylesheet' type='text/css' href='/css/bootstrap-theme.css' />

    {inject name='scriptInclude' type='ScriptServer\Service\ScriptInclude'}
    
    
    {inject name='colorScheme' type='Site\Model\ColorScheme'}
    
    <link rel='stylesheet' type='text/css' href='/css/{$colorScheme->getSelectedCssName()}.css' />
    
</head>

<body>
