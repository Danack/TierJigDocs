<?php


namespace TierDocs\Data;

class BasicExamples implements Examples
{    
    public function getList()
    {
        return [
            'cachingExecutables' => 'Caching Executables',
            'configuration' => 'Configuration',
            'contexts' => 'Contexts',
            //'simpleWebsite' => 'Simple website',
        ];
    }
}