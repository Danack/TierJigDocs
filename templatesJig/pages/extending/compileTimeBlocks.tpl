{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">


        <h2>Compile time blocks</h2>


        <p>
          Jig supports

          This is useful as it allows the functionality to be called once, when the template is initially compiled to
          PHP.
        </p>

        {renderExampleCode example='extending/compileTimeBlocks'}
        {/renderExampleCode}
    </div>
  </div>
{/block}