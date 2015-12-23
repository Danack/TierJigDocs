{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">


        <h2>Compile time blocks</h2>

        <p>
          Compile time blocks are used when the templates are compiled into PHP code, which is done before they are rendered. This allows for expensive operation to be done once without having to redo that operation each time the template is rendered.
        </p>

        <p>
          For example, this site uses compile time blocks to find and extract the example code from source files and add it to the templates. This is done once when the templates are compiled.
        </p>

        {renderTemplateFile extending/compileTimeBlocks/index}
        {/renderTemplateFile}

        {renderOutputFile extending/compileTimeBlocks}
        {/renderOutputFile}
      
        <p>
          The code for setting up the compile time block is:
        </p>
      
        {renderExampleCode example='extending/compileTimeBlocks'}
        {/renderExampleCode}
    </div>
  </div>
{/block}