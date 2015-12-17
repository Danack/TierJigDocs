{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">


        {renderTemplateFile syntax/injecting/index}
        {/renderTemplateFile}


        {renderOutputFile syntax/injecting}
        {/renderOutputFile}
    </div>
  </div>
{/block}