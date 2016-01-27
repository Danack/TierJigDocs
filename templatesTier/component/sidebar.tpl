
{inject name='navItems' type='TierDocs\Data\NavItems'}


<div class="row panel panel-default pastLinks bs-docs-sidebar hidden-print">
  <div class="col-md-12">
    <nav class="bs-docs-sidebar hidden-print">
      <ul class="nav">
        {foreach $navItems as $navItem}
      <li>
          {$navItem->render() | nofilter}
      </li>

          {$navItem->renderChild() | nofilter}
        {/foreach}
      </ul>
    </nav>
  </div>
</div>
