{inject name='links' type='TierJig\Model\InterestingLinks'}
{foreach $links as $link}
    {$link->getUrl()} - {$link->getDescription()}
{/foreach}
