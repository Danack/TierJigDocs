<?php

namespace JigDocs\Data\Examples;

class syntaxinjectingOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'

    <a href="http://chat.stackoverflow.com/rooms/11/php">Room 11</a><br/>
    <a href="http://phpimagick.com">Imagick by example</a><br/>
    <a href="http://tywkiwdbi.blogspot.co.uk/">TYWKIWDBI</a><br/>

OUTPUT;

        return $content;
    }
}