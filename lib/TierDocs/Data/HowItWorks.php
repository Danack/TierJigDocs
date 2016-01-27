<?php


namespace TierDocs\Data;

class HowItWorks implements Examples
{    
    public function getList()
    {
//        ['executing', 'How Tier works', 'How Tier works' ],
//        ['dic', 'Dependency injection', 'Dependency injection'],
//        ['executionControl', 'Execution control', 'Execution control' ],

        return [
            'executing' => 'How Tier works',
            'dic' => 'Dependency injection',
            'executionControl' => 'Execution control',
        ];
    }
}

