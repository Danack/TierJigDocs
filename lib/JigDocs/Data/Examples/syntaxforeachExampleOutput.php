<?php

namespace JigDocs\Data\Examples;

class syntaxforeachExampleOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'
    Key is: 0
    Value is: 1
    Key is: 1
    Value is: 2
    Key is: 2
    Value is: 3
    Key is: 3
    Value is: 4
    Key is: 4
    Value is: 5


 

  Color is: <span style="color: red">red</span>
  Color is: <span style="color: green">green</span>
  Color is: <span style="color: blue">blue</span>

OUTPUT;

        return $content;
    }
}