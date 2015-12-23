<?php

namespace JigDocs\Data\Examples;

class gettingStartedbasicOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
This is a template!

   Hello wolrd!<br/>
   Bonjour le monde!<br/>
   Hallo Welt!<br/>

OUTPUT;

        return $content;
    }
}