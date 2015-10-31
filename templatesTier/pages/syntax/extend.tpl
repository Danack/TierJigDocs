
{extends file="component/blankPage"}

{block name='content'}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                
                
{inject name='examples' type='TierJig\Data\SyntaxExamples'}


                
{renderTemplateFile syntax/extending/index}
{/renderTemplateFile}
                
{renderTemplateFile syntax/extending/parentTemplate}
{/renderTemplateFile}

{renderOutputFile syntax/extending}
{/renderOutputFile}

            </div>
        </div>
    </div>
{/block}