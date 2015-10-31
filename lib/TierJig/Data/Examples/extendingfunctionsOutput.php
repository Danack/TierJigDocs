<?php

namespace TierJig\Data\Examples;

class extendingfunctionsOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'



int(5)

OUTPUT;

        return $content;
    }
}