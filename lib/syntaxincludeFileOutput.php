<?php

namespace TierJig\Data\Examples;

class syntaxincludeFileOutput {

    function renderOutput()
    {
        $content = <<< OUTPUT
This is a template that includes another file.
This is the included file.


Include test passed.

OUTPUT;

        return $content;
    }
}