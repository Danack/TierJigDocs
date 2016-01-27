<?php


namespace JigDocs\Data;

class GettingStartedExamples implements Examples
{    
    public function getList()
    {
        return [
            'vanillaPHP' => 'Vanilla PHP',
            'tierJig' => 'Jig + Tier skeleton app',
            'symfonyZend' => 'Symfony + Zend',
        ];
    }
}

