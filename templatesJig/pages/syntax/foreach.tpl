
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                
<h2>Foreach syntax</h2>

{renderTemplateFile syntax/foreachExample/index}
{/renderTemplateFile}

{renderOutputFile syntax/foreachExample}
{/renderOutputFile}

                
            </div>
        </div>
    </div>
{/block}