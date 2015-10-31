
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

{renderTemplateFile extending/functions/index}
{/renderTemplateFile}

{renderOutputFile extending/functions}
{/renderOutputFile}
   
<p>
{renderExampleCode example='extending/functionplugin'}
{/renderExampleCode}
</p>

            </div>
        </div>
    </div>
{/block}