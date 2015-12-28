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
    
    <h4>Adding a plugin to a template</h4>
    
      <p>
        There are two ways to make a plugin be available in a template, either through a 'plugin' tag in a template, or by adding default plugins to the Jig render objct.
      </p>
      
      
      <h5>Adding plugins inside templates</h5>

      <p>
        You can use the 'plugin' tag to register that a plugin is needed in the current template.
      </p>

      {highlightTemplate}{trim}
      {literal}
This is  a template, the next line adds the plugin to this template.

{plugin type='JigDocs\Plugin\SitePlugin'}

All of the functions, filters and blocks that are registered by 'SitePlugin' can be used in this template.
      {/literal}
      {/trim}{/highlightTemplate}
      
      <p>
        When the template is compiled, Jig just checks that the plugin is available and reads what functions, filters and blocks that plugin provides. The plugin is only instantiated and injected into the template when the template is rendered.
      </p>


      <h5>Adding to all templates</h5>
      
      <p>
      You can add make plugins be available to all templates by registering them with the Jig render object.
        </p>
      
      {highlightCode}
$jig->addDefaultPlugin('JigDocs\Plugin\SitePlugin');
      {/highlightCode}
      
      <p>
        This will make the 'SitePlugin' available to all templates when they are compiled by Jig. If you change the code to remove a default plugin, all of the already compiled templates will need to be recompiled.
      </p>
      
    
    <h4>Making a plugin</h4>
    
    <p>
      To make a plugin you need to make a class that implements the <a href="https://github.com/Danack/Jig/blob/master/src/Jig/Plugin.php" target="_blank">Jig\Plugin</a> interface.
    </p>

    <p>
      Each of the getBlockRenderList, getFilterList, and getFunctionList functions must return an array of the name of the blocks, filters, and functions that you wish for that plugin to provide.
    </p>
    
    <p>
      When a filter from a plugin is used in a template, the callFilter method of the plugin will be called. The first parameter is the filter that should be called, and the second paramter is the string that should be filtered. 
      
     <p>
      Similarly when a function from a plugin is called, the callFunction method will be called. The first parameter will is the function that should be called, and the second parameter is the arguments that the template passed to the function.
      </p>

    <p>For blocks, the callBlockRenderStart method will be called at the start of the block, and the callBlockRenderEnd method will be called at the end of the block.
    </p>


    {renderExampleCode example='extending_plugindefiniton'}
    {/renderExampleCode} 
    
  </div>
{/block}