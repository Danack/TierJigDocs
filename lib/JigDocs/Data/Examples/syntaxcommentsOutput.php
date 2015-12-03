<?php

namespace JigDocs\Data\Examples;

class syntaxcommentsOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'


    
<!-- This is a HMTL comment. -->

OUTPUT;

        return $content;
    }
}