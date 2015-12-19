<?php

namespace JigDocs\Data\Examples;

class syntaxcommentsOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'


    
<!-- This is a HTML comment. -->

OUTPUT;

        return $content;
    }
}