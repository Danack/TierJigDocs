<?php

namespace JigDocs\Data\Examples;

class onepageexampleOutput {

    function renderOutput()
    {
        $content = <<< 'OUTPUT'





  color is <span style="red">red</span> <br/>
  color is <span style="green">green</span> <br/>
  color is <span style="blue">blue</span> <br/>





This text has come from the included file.



    This text is from the child block






a test string


This is the start of the block. extra text is 'foo='bar''
line 3
line 2
line 1



Reversed - gnirtS tseT A





The twitter handle for Danack is
<a href="https://twitter.com/MrDanack">
  MrDanack
</a>

OUTPUT;

        return $content;
    }
}