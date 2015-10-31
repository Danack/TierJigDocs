<?php


namespace TierJig\Plugin;

use Jig\JigException;
use Jig\Plugin\EmptyPlugin;

//Example extending_functionplugin
class FunctionPlugin extends EmptyPlugin
{
    public static function getFunctionList()
    {
        return ['var_dump'];
    }
 
    /**
     * Call the function named 'functionName' with a set of parameters
     * @param $functionName
     * @param array $params
     * @return mixed
     */
    public function callFunction($functionName, array $params)
    {
        throw new JigException("callFunction called for unknown function '$functionName'");
    }
}
//Example end