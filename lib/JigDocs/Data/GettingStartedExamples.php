<?php


namespace JigDocs\Data;

class GettingStartedExamples implements Examples
{    
    public function getList()
    {
        return [
            'purePHP' => 'PurePHP',
            'tierJig' => 'Jig + Tier skeleton app',
            'symfonyZend' => 'Symfony + Zend',
        ];
    }
}

