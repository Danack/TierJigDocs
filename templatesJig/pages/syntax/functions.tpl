{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
        <h2>Functions</h2>

        {renderTemplateFile syntax/basic/index}
        {/renderTemplateFile}

        {renderOutputFile syntax/basic}
        {/renderOutputFile}
    </div>
  </div>
{/block}