{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>Functions</h2>

      <p>
        Functions can be called, which is nice. Jig does not include any functions by default, instead functions must be brought into the template by adding a plugin to it.
      </p>

      {renderTemplateFile syntax/functions/index}
      {/renderTemplateFile}

      {renderOutputFile syntax/functions}
      {/renderOutputFile}
    </div>
  </div>
{/block}