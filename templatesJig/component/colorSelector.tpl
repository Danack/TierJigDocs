
{inject name='scriptInclude' type='ScriptServer\Service\ScriptInclude'}


{inject name='colorScheme' type='TierJig\Model\ColorScheme'}
<select id='colorSelector'>
{foreach $colorScheme->getColorSchemes() as $filename => $description}
    <option value='{$filename | html_attr}'>
        {$description}
    </option>
{/foreach}
</select>


{$scriptInclude->addBodyLoadFunction("initColorSelector('#colorSelector');")}
    
    