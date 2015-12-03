
{inject name='navItems' type='TierDocs\Data\NavItems'}


<nav class="bs-docs-sidebar hidden-print">

    <ul class="nav">
        {foreach $navItems as $navItem}
        <li>
            {$navItem->render() | nofilter}
        </li>

        {$navItem->renderChild() | nofilter}

        {/foreach}
    </ul>

    {* include file='component/colorSelector' *}
</nav>