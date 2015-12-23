<div class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a href="/" class="navbar-brand">Jig</a>

      <div class="visible-sm visible-xs hidden-md hidden-lg navbar-right">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                  data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
      </div>
    </div>
    
    <div class="collapse" id="bs-example-navbar-collapse-1">
      {inject name='navItems' type='JigDocs\Data\NavItems'}

      <ul class="nav nav-list">
        {foreach $navItems as $navItem}
        <li>
          {$navItem->render() | nofilter}
        </li>

          {$subExamples = $navItem->getExamples()}
          {if $subExamples}
            {$exampleList = $subExamples->getList()}
            {foreach $exampleList as $path => $description}
              <li><a href="{$navItem->getPath()}/{$path}">{$navItem->getDescription()}-{$description}</a></li>
            {/foreach}
          {/if}
        {/foreach}
      </ul>

      
      
    </div>

  <!--
    <div class="visible-sm visible-xs">
      <div class="collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
          <li><a href="#">Link</a></li>
          <li class="dropdown">
        </ul>
      </div>
    </div>
    -->

    <div class="visible-md visible-lg navbar-right">
      
      <ul class="nav navbar-nav">
        <li><a href="/gettingStarted">Getting started</a></li>
        <li>
          <a class="github" href="https://github.com/Danack/Jig">
            Source on Github
          </a>
        </li>
      </ul>
    </div>


  </div>
</div>
    