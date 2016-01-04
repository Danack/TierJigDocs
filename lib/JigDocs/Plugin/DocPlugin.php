<?php


namespace JigDocs\Plugin;

use Jig\Plugin;
use Jig\JigException;

//Example extending_plugindefiniton
class DocPlugin implements Plugin
{
    /**
     * Return the list of blocks provided by this plugin.
     * @return string[]
     */
    public static function getBlockRenderList()
    {
        return ['docBlock'];
    }

    /**
     * Return the list of filters provided by this plugin.
     * @return string[]
     */
    public static function getFilterList()
    {
        return ['docFilter'];
    }

    /**
     * Return the list of functions provided by this plugin.
     * @return string[]
     */
    public static function getFunctionList()
    {
        return [
            'docFunction',
        ];
    }

    /**
     * @param string $filterName The name of the filter.
     * @param string $string
     * @throws JigException
     * @return mixed
     */
    public function callFilter($filterName, $string)
    {
        if (method_exists($this, $filterName) == true) {
            return call_user_func([$this, $filterName], $string);
        }
        $message = "callFilter for unsupported filter $filterName in ".get_class($this);
        throw new JigException($message);
    }

    /**
     * @param string $functionName
     * @param array $params
     * @return string
     * @throws JigException
     */
    public function callFunction($functionName, array $params)
    {
        if (method_exists($this, $functionName) == true) {
            return call_user_func_array([$this, $functionName], $params);
        }

        $message = "callFunction for unsupported function $functionName in ".get_class($this);

        throw new JigException($message);
    }

    /**
     * @param $blockName
     * @param string $extraParam
     * @return string
     * @throws JigException
     */
    public function callBlockRenderStart($blockName, $extraParam)
    {
        $blockNameStart = $blockName."BlockRenderStart";

        if (method_exists($this, $blockNameStart) == true) {
            return call_user_func([$this, $blockNameStart], $extraParam);
        }

        $message = "callBlockRenderStart for unsupported block $blockName in ".get_class($this);
        
        throw new JigException($message);
    }

    /**
     * @param string $blockName
     * @param string $contents
     * @return mixed
     * @throws JigException
     */
    public function callBlockRenderEnd($blockName, $contents)
    {
        $blockNameEnd = $blockName."RenderEnd";
        if (method_exists($this, $blockNameEnd) == true) {
            return call_user_func([$this, $blockNameEnd], $contents);
        }
        
        $message = "callBlockRenderEnd for unsupported block $blockName in ".get_class($this);
        
        throw new JigException($message);
    }

    function docFilter($string)
    {
        return strtolower($string);
    }
    
    function docFunction($x, $y)
    {
        return "The total is ".($x + $y);
    }
    
    function docBlockRenderStart($extraParam)
    {
        return "This is the stating block. The extra param was '$extraParam'";
    }

    function docBlockRenderEnd($contents)
    {
        $output = strtolower($contents);
        $output .= "This is the end of the block.";

        return $output;
    }
}
//Example end