<?php

namespace JigDocs\Data\Examples;

class filtersbuiltinOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
This is a test &#039;&lt;i&gt;&#039; string &#039;&lt;/i&gt;&#039;.
This&#x20;is&#x20;a&#x20;test&#x20;&#x27;&lt;i&gt;&#x27;&#x20;string&#x20;&#x27;&lt;&#x2F;i&gt;&#x27;.
This\x20is\x20a\x20test\x20\x27\x3Ci\x3E\x27\x20string\x20\x27\x3C\x2Fi\x3E\x27.
This\20 is\20 a\20 test\20 \27 \3C i\3E \27 \20 string\20 \27 \3C \2F i\3E \27 \2E 
This%20is%20a%20test%20%27%3Ci%3E%27%20string%20%27%3C%2Fi%3E%27.
This is a test '<i>' string '</i>'.
OUTPUT;

        return $content;
    }
}