{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      
        <h2>Literal blocks other templates</h2>
      
        {renderTemplateFile syntax/literal/index}
        {/renderTemplateFile}

        {renderOutputFile syntax/literal}
        {/renderOutputFile}
    </div>
  </div>
{/block}