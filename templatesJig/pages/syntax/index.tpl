{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
        <h2>Jig Syntax</h2>

        <p>
          Jig is based on a simplified version of PHP syntax. The main differences are:
        </p>

        <ul>
          <li>No need for semi-colons at ends of lines.</li>
          <li>Any code that isn't an assignment will be printed to the output.</li>
          <li>All output is sent through an <a href="/filters">output filter</a> to escape HTML entities by default.</li>
        </ul>

        <h3>Syntax list</h3>
        {inject name='examples' type='JigDocs\Data\SyntaxExamples'}
        <ul class="functionList">
        {foreach $examples->getList() as $path => $description}
          <li><a href="/syntax/{$path | url}">{$description}</a></li>
        {/foreach}
        </ul>
    </div>
  </div>
{/block}

