
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

{renderTemplateFile syntax/literal/index}
{/renderTemplateFile}

{renderOutputFile syntax/literal}
{/renderOutputFile}

            </div>
        </div>
    </div>
{/block}