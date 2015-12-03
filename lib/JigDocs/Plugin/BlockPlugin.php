<?php


namespace JigDocs\Plugin;

use Jig\JigException;
use Jig\Plugin\EmptyPlugin;

class BlockPlugin extends EmptyPlugin
{
    public static function getFunctionList()
    {
        return [];
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
