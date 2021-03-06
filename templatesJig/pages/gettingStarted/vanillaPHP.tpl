{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Vanilla PHP
      </h2>

      <p>
        The code below shows how to create a JigConfig object, and then instantiate a Jig object to do the rendering. 
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