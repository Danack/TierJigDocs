{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

        <h2>The one page example</h2>

        <p>
          This example <strike>shows</strike> will show all of the features of Jig on a single page.

        </p>

        {renderTemplateFile onepage/example/parent}
        {/renderTemplateFile}
      
        {renderTemplateFile onepage/example/index}
        {/renderTemplateFile}
      
        {renderTemplateFile onepage/example/an_include}
        {/renderTemplateFile}

        {renderOutputFile onepage/example}
        {/renderOutputFile}

        <p>
          {renderExampleCode example='onepage_plugin'}
          {/renderExampleCode}
        </p>
    </div>
  </div>
{/block}