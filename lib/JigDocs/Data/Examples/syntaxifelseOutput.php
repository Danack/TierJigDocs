<?php

namespace JigDocs\Data\Examples;

class syntaxifelseOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'

 
    $x is not zero.


  
    $x is less than 10.


OUTPUT;

        return $content;
    }
}