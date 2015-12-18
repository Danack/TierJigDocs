<?php


namespace JigDocs\Plugin;

use Jig\JigException;
use Jig\Plugin\EmptyPlugin;

//Example extending_functionplugin
class FunctionPlugin extends EmptyPlugin
{
    public static function getFunctionList()
    {
        return ['reverse'];
    }

    public function callFunction($functionName, array $params)
    {
        if (!in_array($functionName, self::getFunctionList())) {
            throw new JigException("Unknown function $functionName");
        }

        return call_user_func_array([$this, 'reverseString'], $params);
    }

    public function reverseString($string1, $string2)
    {
        return strrev($string2)." ".strrev($string1);
    }
    
}
//Example end