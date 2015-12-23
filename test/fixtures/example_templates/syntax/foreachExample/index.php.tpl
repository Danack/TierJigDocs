{$array = [1, 2, 3, 4, 5]}
{foreach $array as $key => $value}
    Key is: {$key}
    Value is: {$value}
{/foreach}

{* This example adds a plugin to the template. *}
{* The plugin provides the function 'getColors' *} 
{plugin type='JigDocs\Plugin\ExamplePlugin'}
{foreach getColors() as $color}
  Color is: <span style="color: {$color | attr}">{$color}</span>
{/foreach}