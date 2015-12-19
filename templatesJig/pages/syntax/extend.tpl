{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

      <h2>Extending other templates</h2>

        {renderTemplateFile syntax/extending/index}
        {/renderTemplateFile}

        {renderTemplateFile syntax/extending/parentTemplate}
        {/renderTemplateFile}

        {renderOutputFile syntax/extending}
        {/renderOutputFile}
    </div>
  </div>
{/block}