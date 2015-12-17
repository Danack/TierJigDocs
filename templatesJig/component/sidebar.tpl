
{inject name='navItems' type='JigDocs\Data\NavItems'}

<div class="row panel panel-default pastLinks bs-docs-sidebar hidden-print">
  <div class="col-md-12">
    <ul class="nav nav-list smallPadding">
        {foreach $navItems as $navItem}
      <li>
        {$navItem->render() | nofilter}
      </li>

        {$navItem->renderChild() | nofilter}

      {/foreach}
    </ul>
  {* include file='component/colorSelector' *}
  </div>
</div>