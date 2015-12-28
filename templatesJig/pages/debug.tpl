{extends file="component/blankPage"}

{plugin name='JigDocs\Plugin\SitePlugin'}

{block name='content'}

  <div class="row panel panel-default">
    <div class="col-md-12">

Shmoan
      {$foo = "bar"}

      {$foo = test($foo)}
      
      {$foo}

    </div>
  </div>
{/block}