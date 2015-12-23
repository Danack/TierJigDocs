{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      
      <h2>Plugin - blocks</h2>

      <h4>
        Example
      </h4>
      <p>
      The example below defines a filter called 'nospaces' that removes all spacs from the output string when it is used.
      </p>

        {renderTemplateFile extending/blocks/index}
        {/renderTemplateFile}

        {renderOutputFile extending/blocks}
        {/renderOutputFile}

        <p>
          {renderExampleCode example='extending/blockplugin'}
          {/renderExampleCode}
        </p>

      
      
    </div>
  </div>
{/block}