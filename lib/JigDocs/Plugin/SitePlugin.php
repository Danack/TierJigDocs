<?php

namespace JigDocs\Plugin;

use Jig\JigException;

class SitePlugin implements \Jig\Plugin
{

    /**
     * The list of global functions that this plugin allows
     * people to call in a template.
     * @var array
     */
    private static $globalFunctions = array(
//        'var_dump',
    );

    /**
     * Return the list of blocks provided by this plugin.
     * @return string[]
     */
    public static function getBlockRenderList()
    {
        return [
        ];
    }

    /**
     * Return the list of functions provided by this plugin.
     * @return string[]
     */
    public static function getFunctionList()
    {
        $methodFunctions = [
            'methodFunction'
        ];
        
        return array_merge($methodFunctions, self::$globalFunctions);
    }

    /**
     * @param string $functionName
     * @param array $params
     * @return mixed
     * @throws JigException
     */
    public function callFunction($functionName, array $params)
    {
        if (in_array($functionName, self::$globalFunctions)) {
            return call_user_func_array($functionName, $params);
        }
        
        if (method_exists($this, $functionName) == true) {
            return call_user_func_array([$this, $functionName], $params);
        }

        $message = "callFunction for unsupported function $functionName in ".get_class($this);

        throw new JigException($message);
    }

    /**
     * @param $blockName
     * @param string $extraParam
     * @throws JigException
     * @return mixed
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
     * @throws JigException
     * @return mixed
     */
    public function callBlockRenderEnd($blockName, $contents)
    {
        $blockNameEnd = $blockName."BlockRenderEnd";

        if (method_exists($this, $blockNameEnd) == true) {
            return call_user_func([$this, $blockNameEnd], $contents);
        }
        
        $message = "callBlockRenderEnd for unsupported block $blockName in ".get_class($this);
        
        throw new JigException($message);
    }

    public function trimBlockRenderStart($segmentText)
    {
        return "";
    }

    /**
     * @param $content
     * @return string
     */
    public function trimBlockRenderEnd($content)
    {
        return trim($content);
    }

//Example_plugins_filters
    /**
     * Return the list of filters provided by this plugin.
     * @return string[]
     */
    public static function getFilterList()
    {
        return ['nospaces'];
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

    private function nospaces($inputString)
    {
        return str_replace(' ', '', $inputString);
    }
    
    function test($item)
    {
        return $item;
    }
    
//Example_end
}
