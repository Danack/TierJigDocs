
{inject name='scriptInclude' type='ScriptHelper\ScriptInclude'}


{inject name='colorScheme' type='Site\Model\ColorScheme'}
<select id='colorSelector'>
{foreach $colorScheme->getColorSchemes() as $filename => $description}
    <option value='{$filename | html_attr}'>
        {$description}
    </option>
{/foreach}
</select>


{$scriptInclude->addBodyLoadJS("initColorSelector('#colorSelector');")}
    
    