<?php

namespace JigDocs\Data\Examples;

class injectorsharingOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
Initial object is shared.
OUTPUT;

        return $content;
    }
}