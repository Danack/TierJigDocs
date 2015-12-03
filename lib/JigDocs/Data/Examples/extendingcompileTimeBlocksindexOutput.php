<?php

namespace TierJig\Data\Examples;

class extendingcompileTimeBlocksindexOutput {

    function renderOutput()
    {
        $content = <<< OUTPUT

This is before the block

This is the block start

This template was compiled as %DATE_COMPILED%

This is the block start



This is after the block
OUTPUT;

        return $content;
    }
}