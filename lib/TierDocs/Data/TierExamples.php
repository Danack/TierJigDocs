<?php


namespace TierDocs\Data;

class TierExamples implements Examples
{
    public function getList()
    {
//        ['caching' => 'Caching content', 'Full caching description' ],
//            ['configuration' => 'App configuration', 'Getting application configuation into an application'],
//            ['contexts' => 'Contexts', 'Contexts for application security' ],
        
        return [
            'caching' => 'Caching content',
            'configuration' => 'App configuration',
            'contexts' => 'Contexts',
        ];
    }
}
