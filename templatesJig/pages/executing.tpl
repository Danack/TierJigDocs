{extends file="component/blankPage"}

{block name='content'}
  <div class="row panel panel-default">
    <div class="col-md-12">
        <p>
          Because all the dependencies that are needed by a template need to be passed in as variables

          Because

        </p>
                
                
<pre>
    
<?php

use Jig\Jig;
use Jig\JigConfig;

$jigConfig = new JigConfig(
    "./templates",
    "./var/compile",
    "php.tpl",
    Jig::COMPILE_CHECK_EXISTS
);


$jig = new Jig($jigConfig)
$jig->checkTemplateCompiled($templateFilename);
$className = $this->jigConfig->getFullClassname($templateFilename);
$contents = $this->injector->execute([$className, 'render']);
    
    
</pre>

    </div>
  </div>
{/block}