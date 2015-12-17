{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
        <h2>Plugins in templates</h2>

        <p>
          As well as being bound programmatically in code, templates can include plugins themselves.
          {literal}
            {plugin type='JigTest\PlaceHolder\PlaceHolderPlugin'}
          {/literal}
        </p>

        {renderTemplateFile syntax/basic/index}
        {/renderTemplateFile}

        {renderOutputFile syntax/basic}
        {/renderOutputFile}
    </div>
  </div>
{/block}