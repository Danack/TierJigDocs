{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">


        {renderTemplateFile extending/functions/index}
        {/renderTemplateFile}

        {renderOutputFile extending/functions}
        {/renderOutputFile}

        <p>
          {renderExampleCode example='extending/functionplugin'}
          {/renderExampleCode}
        </p>
    </div>
  </div>
{/block}