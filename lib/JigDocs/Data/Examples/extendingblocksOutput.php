<?php

namespace JigDocs\Data\Examples;

class extendingblocksOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'

This is the start of the block
<p>
    all the content inside this block is passed to the blockplugin::callblockrenderend function.
</p>
This is the end of the block.

OUTPUT;

        return $content;
    }
}