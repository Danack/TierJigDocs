{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

      <h2>Plugins</h2>
      
      <p>
      Plugins add functionality to the Jig templates that is available when the templates are rendered. Plugins can add three different things to the templates.
      </p>
      
      <p>
          <a href='/extending/functions'>Functions</a> allow you to define functions that can be called from within templates. 
      </p>

      <p>  
        <a href='/extending/blocks'>Blocks</a>
        Blocks allow you to define block level elements for templates. For example the built in 
        {literal}
        {trim}
        {/trim}
        {/literal}
        functionality is implmented with a block.
      </p>

      <p>
        <a href='/extending/blocks'>Filters</a> allow the output to be modified.
      </p>
    </div>
  </div>
{/block}