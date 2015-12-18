<?php

namespace JigDocs\Data\Examples;

class filtersbuiltinOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
This is a test &#039;&lt;&#039; string. 
This&#x20;is&#x20;a&#x20;test&#x20;&#x27;&lt;&#x27;&#x20;string.&#x20;
This\x20is\x20a\x20test\x20\x27\x3C\x27\x20string.\x20
This\20 is\20 a\20 test\20 \27 \3C \27 \20 string\2E \20 
This%20is%20a%20test%20%27%3C%27%20string.%20
This is a test '<' string. 
OUTPUT;

        return $content;
    }
}