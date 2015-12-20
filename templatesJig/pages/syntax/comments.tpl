{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
    
      <h2>Comments</h2>
      
        {renderTemplateFile syntax/comments/index}
        {/renderTemplateFile}

        {renderOutputFile syntax/comments}
        {/renderOutputFile}

    
    </div>
  </div>
{/block}