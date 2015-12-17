{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">

        <h2>Extending Jig</h2>

        The functionality available in a Jig template can be extended with either plugins or compile time blocks

        <h3>Plugins</h3>

        Plugins add functionality to the Jig templates that is available when the templates are rendered. Plugins can
        add three different things:

        <h4>Functions</h4>

        <p>
          Functions allow functions to be called.
        </p>

        <h4>Blocks</h4>

        <p>
          Blocks allow blocks of templates to be processed.
        </p>

        <h4>Filters</h4>

        <p>
          Filters allow the output to be modified.
        </p>


        <h3>Compile time blocks</h3>

        <p>
          Compile time blocks affect how the templates are compiled into PHP code, which is done before they are
          rendered. This allows for expensive operation to be done once without having to redo that operation each time
          the template is rendered.
        </p>

        <p>
          For example, this site uses compile time blocks to find and extract the example code from source files and add
          it to the templates. This is done once when the templates are compiled.
        </p>
    </div>
  </div>
{/block}