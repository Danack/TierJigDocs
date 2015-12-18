<?php

namespace JigDocs\Data\Examples;

class extendingcompileTimeBlocksindexOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'


This is the block startExtra text is foo='bar'

This template was compiled as %DATE_COMPILED%

This is the block endThis extra params were '/replaceCompileTime bar='foo''
OUTPUT;

        return $content;
    }
}