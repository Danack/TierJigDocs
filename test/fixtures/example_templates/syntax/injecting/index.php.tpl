{inject name='links' type='Site\Model\InterestingLinks'}
{foreach $links as $link}
    {$link->getUrl()} - {$link->getDescription()}
{/foreach}
