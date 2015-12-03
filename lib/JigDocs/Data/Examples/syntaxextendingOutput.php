<?php

namespace JigDocs\Data\Examples;

class syntaxextendingOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'


This is before the block.


    This block is set in the template that extends the parent template.



This is between the blocks


    This is block is not set in the template that extends the parent template. It has the content
    that was set in the parent block



This is after the blocks.



OUTPUT;

        return $content;
    }
}