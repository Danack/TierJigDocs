<?php

namespace JigDocs\Data\Examples;

class extendingcompileTimeBlocksOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
This is the block startExtra text is startParam='foo'

This is some template text.

This is the block end
Extra text is "/replaceCompileTime endingParam='bar'"

OUTPUT;

        return $content;
    }
}