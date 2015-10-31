
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                

{renderTemplateFile syntax/injecting/index}
{/renderTemplateFile}


{renderOutputFile syntax/injecting}
{/renderOutputFile}
                

            </div>
        </div>
    </div>
{/block}