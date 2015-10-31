
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

{renderTemplateFile syntax/comments/index}
{/renderTemplateFile}

{renderOutputFile syntax/comments}
{/renderOutputFile}

            </div>
        </div>
    </div>
{/block}