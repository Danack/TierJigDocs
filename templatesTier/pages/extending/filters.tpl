
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

{renderTemplateFile extending/filters/index}
{/renderTemplateFile}

{renderOutputFile extending/filters}
{/renderOutputFile}

    
                
<p>
{renderExampleCode example='extending/filterplugin'}
{/renderExampleCode}
</p>


            </div>
        </div>
    </div>
{/block}