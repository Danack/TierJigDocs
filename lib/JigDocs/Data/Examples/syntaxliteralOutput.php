<?php

namespace JigDocs\Data\Examples;

class syntaxliteralOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'


This is a literal block. All other Jig syntax is ignored until the end of the literal block.

{* This comment block would normally would be hidden by Jig. *}


OUTPUT;

        return $content;
    }
}