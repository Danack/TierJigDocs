<?php

namespace JigDocs\Data\Examples;

class syntaxinjectingOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'

    http://chat.stackoverflow.com/rooms/11/php - Room 11
    http://phpimagick.com - Imagick by example
    http://tywkiwdbi.blogspot.co.uk/ - TYWKIWDBI

OUTPUT;

        return $content;
    }
}