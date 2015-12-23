{inject name='links' type='Site\Model\InterestingLinks'}
{foreach $links as $link}
    <a href="{$link->getUrl()}">{$link->getDescription()}</a><br/>
{/foreach}
