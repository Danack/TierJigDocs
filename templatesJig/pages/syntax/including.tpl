{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

        {renderTemplateFile syntax/includeFile/index}
        {/renderTemplateFile}

        {renderTemplateFile syntax/includeFile/includedFile}
        {/renderTemplateFile}

        {renderOutputFile syntax/includeFile}
        {/renderOutputFile}
    </div>
  </div>
{/block}