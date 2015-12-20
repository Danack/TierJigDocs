<?php

//Example onepage_plugin
namespace JigDocs\Plugin;

use Jig\Plugin;
use Jig\JigException;

class OnePagePlugin implements Plugin
{
    /**
     * Return the list of blocks provided by this plugin.
     * @return string[]
     */
    public static function getBlockRenderList()
    {
        return ['onePageBlock'];
    }

    /**
     * Return the list of filters provided by this plugin.
     * @return string[]
     */
    public static function getFilterList()
    {
        return ['onePageFilter'];
    }

    /**
     * Return the list of functions provided by this plugin.
     * @return string[]
     */
    public static function getFunctionList()
    {
        return ['onePageFunction'];
    }
    
    /**
     * Call the function named 'functionName' with a set of parameters
     * @param $functionName
     * @param array $params
     * @return mixed
     */
    public function callFunction($functionName, array $params)
    {
        if ($functionName !== 'onePageFunction') {
            throw new JigException("callFunction called for unknown function '$functionName'");
        }

        return call_user_func_array([$this, 'onePageFunction'], $params);
    }
    
    private function onePageFunction($string)
    {
        return strrev($string);
    }
    

    /**
     * Call the filter named 'filterName' for the string.
     * @param string $filterName The name of the filter.
     * @param string $string
     * @return mixed
     */
    public function callFilter($filterName, $string)
    {
        if ($filterName !== 'onePageFilter') {
            throw new JigException("callFilter called for unknown function '$filterName'");
        }

        return strtolower($string);
    }

    /**
     * Call the start function for the block named 'blockName' with any extra provided
     * parameters.
     * @param $blockName
     * @param string $extraParam
     * @return mixed
     */
    public function callBlockRenderStart($blockName, $extraParam)
    {
        if ($blockName !== 'onePageBlock') {
            throw new JigException("callBlockRenderStart called for unknown block '$blockName'");
        }
        return "This is the start of the block. extra text is '$extraParam'";
    }

    /**
     * Call the end function for the block named 'blockName' with any extra provided
     * parameters.
     * @param $blockName
     * @param string $contents
     * @return mixed
     */
    public function callBlockRenderEnd($blockName, $contents)
    {
        if ($blockName !== 'onePageBlock') {
             throw new JigException("callBlockRenderEnd called for unknown block '$blockName'");
        }
        $lines = explode("\n", $contents);
        $reversedLines = array_reverse($lines);

        return implode("\n", $reversedLines);
    }
}

//Example end