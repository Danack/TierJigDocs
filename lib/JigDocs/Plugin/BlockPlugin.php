<?php

//Example extending_blockplugin
namespace JigDocs\Plugin;

use Jig\Plugin\EmptyPlugin;

class BlockPlugin extends EmptyPlugin
{
    public static function getBlockRenderList()
    {
        return ['lowercase'];
    }

    public function callBlockRenderStart($blockName, $extraParam)
    {
        return "This is the start of the block";
    }

    public function callBlockRenderEnd($blockName, $contents)
    {
        $contents = strtolower($contents);
        $contents .= "This is the end of the block.";

        return $contents;
    }
}
//Example end