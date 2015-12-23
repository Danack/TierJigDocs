{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
    
      <h2>Comments</h2>
      
      <p>
        Comments allow you to document how a template works.
      </p>
      
      {renderTemplateFile syntax/comments/index}
      {/renderTemplateFile}

      {renderOutputFile syntax/comments}
      {/renderOutputFile}

    </div>
  </div>
{/block}