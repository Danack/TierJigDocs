{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
      <h2>
        Getting started
      </h2>

      <p>
          To add Jig to a PHP project, run 'composer require danack/jig' or otherwise add it to your composer.json file.
      </p>
        
      <p>Before using it you will need to:</p>
      
      <ul>
        <li>Create a directory to hold templates, and create some templates in there.</li>
        <li>Create a directory to store the PHP compiled versions of templates.</li>
        <li>Make sure your autoloader can find the compiled files. If you are using PSR-0, this is as simple as adding
          <code>"Jig/CompiledTemplate": "var/compilejig/",</code> to your composer "autoload" "psr-0" section.
        </li>
      </ul>
      
      <h4>
        Specific setup examples
      </h4>
      
      <ul class="functionList">
        <li><a href="/gettingStarted/vanillaPHP">Vanilla PHP</a></li>
        <li><a href="/gettingStarted/tierJig">Jig + Tier skeleton app</a></li>
        <li><a href="/gettingStarted/symfonyZend">Using Jig with Symfony or Zend frameworks</a></li>
      </ul>
      
    </div>
  </div>
{/block}


