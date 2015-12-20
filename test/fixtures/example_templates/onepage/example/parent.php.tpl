{* This is a comment *}

{* Assign an array of colors to a variable *}
{$colors = ['red', 'green', 'blue']}

{* Loop over the values of $colors *}
{foreach $colors as $color}
  color is <span style="{$color | attr}">{$color}</span> <br/>
{/foreach}

{* Include another template *}
{include file='onepage/example/an_include'}

{* Declare a named block. Any template that extends this template can replace the block *}
{block name='overriddenBlock'}
    This text is from the parent template.
{/block}

{* Register the plugin in this template *}
{plugin type='JigDocs\Plugin\OnePagePlugin'}

{* Filter the output of the string by the filter provided by the OnePagePlugin *}
{"A Test String" | onePageFilter}

{* Process a block of text with the block provided by the OnePagePlugin *}
{onePageBlock foo='bar'}
line 1
line 2
line 3
{/onePageBlock}

{* Filter the output of the string by the filter provided by the OnePagePlugin *}
{onePageFunction("A Test String - desreveR")}

{* Inject an object into the template *}
{inject name='userInfo' type='JigDocs\Model\UserInfo'}

{* Output some text with the default HTML filtering for the name, and URL encoding for the URI *}
The twitter handle for {$userInfo->getName()} is
<a href="https://twitter.com/{$userInfo->getTwitterHandle() | url}">
  {$userInfo->getTwitterHandle()}
</a>
