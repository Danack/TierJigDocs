<?php

namespace JigDocs\Data\Examples;

class unitTestingbasicOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'

This is a mock contact us string
OUTPUT;

        return $content;
    }
}