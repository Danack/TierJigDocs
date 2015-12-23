{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>Including other templates</h2>

      <p>
         The 'include' tag allows you to include another template in the current template. The included template will be rendered into the current template in place of the include tag. The file 'parameter' should be the filename of the template you want to include, relative to the root directory for your templates, and without the template filename extension.  
      </p>
      
      {renderTemplateFile syntax/includeFile/index}
      {/renderTemplateFile}

      {renderTemplateFile syntax/includeFile/includedFile}
      {/renderTemplateFile}

      {renderOutputFile syntax/includeFile}
      {/renderOutputFile}
      
      <p>
        Note - it is not possible to pass 'scoped' variables to the included template. If you need that sort of functionality, please use a plugin.
      </p>
      
    </div>
  </div>
{/block}