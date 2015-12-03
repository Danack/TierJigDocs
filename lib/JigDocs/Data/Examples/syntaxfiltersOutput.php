<?php

namespace JigDocs\Data\Examples;

class syntaxfiltersOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'

Pen &gt; sword

Pen > sword

OUTPUT;

        return $content;
    }
}