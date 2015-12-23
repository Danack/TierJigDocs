{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

      <h2>Extending other templates</h2>
      
      <p>
        The 'extends' tag allows you to extend one template from another, similar to extending classes in PHP.
      </p>

      <p>Jig allows you to define 'blocks' in templates. Any block in a template that extends another (aka the child template) that has the same name as a block in the extended (aka parent) template, will replace that block when the child template is rendered. </p>

      {renderTemplateFile syntax/extending/index}
      {/renderTemplateFile}

      {renderTemplateFile syntax/extending/parentTemplate}
      {/renderTemplateFile}

      <p>
        Rendering the template 'syntax/extending/index' gives this result:
      </p>

      {renderOutputFile syntax/extending}
      {/renderOutputFile}
      
      <p>
        Note - Jig does not support dynamic inheritance. This is due to the fact that with dynamic inheritance it is not possible to determine the dependencies the template needs before rendering the template.
      </p>
      
    </div>
  </div>
{/block}