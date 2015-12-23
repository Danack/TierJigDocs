{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>Basic syntax</h2>

      <p>
        Below you will find an example of the basic syntax in Jig. The 'template' box shows the text of the Jig template before it is rendered. The output box shows the output of the template after it has been rendered. You can view the output as 'pre' formatted', HTML with extra line breaks (for legibility) or plain HTML.
      </p>
      
      {renderTemplateFile syntax/basic/index}
      {/renderTemplateFile}

      {renderOutputFile syntax/basic}
      {/renderOutputFile}
    </div>
  </div>
{/block}