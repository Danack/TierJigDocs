<?php


namespace TierJig\Plugin;

use Jig\JigException;
use Jig\Plugin\EmptyPlugin;

//Example extending_filterplugin
class FilterPlugin extends EmptyPlugin
{
    /**
     * Return the list of filters provided by this plugin.
     * @return string[]
     */
    public static function getFilterList()
    {
        return ['nospaces'];
    }
    
    /**
     * Call the filter named 'filterName' for the string.
     * @param string $filterName The name of the filter.
     * @param string $string
     * @return mixed
     */
    public function callFilter($filterName, $inputString)
    {
        if ($filterName == 'nospaces') {
            return str_replace(' ', '', $inputString);
        }

        throw new JigException("callFilter called for unknown filter '$filterName'");
    }
}
//Example end
