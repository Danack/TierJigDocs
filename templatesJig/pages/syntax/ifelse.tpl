{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

        <h2>If/else Syntax</h2>

        <p>
          The 'if' and 'else' statements are the same as they are in PHP, except the () brackets can be left off.
        </p>
      
        {renderTemplateFile syntax/ifelse/index}
        {/renderTemplateFile}

        {renderOutputFile syntax/ifelse}
        {/renderOutputFile}
      
        <p>
          Note - elseif statements are not supported yet.
        </p>
    </div>
  </div>
{/block}