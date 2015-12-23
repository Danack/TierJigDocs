{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Getting started
      </h2>

      <p>
        Words about how to get started go here.
      </p>
      

        <p>
          {renderExampleCode example='gettingStarted/basic'}
          {/renderExampleCode}
        </p>
      
        
        {renderTemplateFile gettingStarted/basic}
        {/renderTemplateFile}

        {renderOutputFile gettingStarted/basic}
        {/renderOutputFile}

      
    </div>
  </div>
{/block}