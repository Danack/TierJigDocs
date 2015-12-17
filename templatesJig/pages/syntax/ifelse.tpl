{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

        <h2>If/else Syntax</h2>

        {renderTemplateFile syntax/ifelse/index}
        {/renderTemplateFile}

        {renderOutputFile syntax/ifelse}
        {/renderOutputFile}
    </div>
  </div>
{/block}