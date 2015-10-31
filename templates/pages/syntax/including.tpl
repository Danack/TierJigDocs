
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
    
{renderTemplateFile syntax/includeFile/index}
{/renderTemplateFile}
                
{renderTemplateFile syntax/includeFile/includedFile}
{/renderTemplateFile}

{renderOutputFile syntax/includeFile}
{/renderOutputFile}

            </div>
        </div>
    </div>
{/block}