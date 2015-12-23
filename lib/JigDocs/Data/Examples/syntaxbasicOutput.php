<?php

namespace JigDocs\Data\Examples;

class syntaxbasicOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
This first line is output without modification.

{Jig syntax is line based. As these curly brackets are on separate lines, 
they do not get parsed as Jig Syntax}

The line after this sets $x to be 5, but there is no output as there is an assignment.

The line after this outputs $x, as there is no assignment on the line.
5

OUTPUT;

        return $content;
    }
}