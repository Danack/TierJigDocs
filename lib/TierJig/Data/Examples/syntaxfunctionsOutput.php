<?php

namespace TierJig\Data\Examples;

class syntaxfunctionsOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'


Pen &gt; sword

Pen > sword



OUTPUT;

        return $content;
    }
}