<?php

namespace JigDocs\Data\Examples;

class gettingStartedbasicOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
This is a template!
OUTPUT;

        return $content;
    }
}