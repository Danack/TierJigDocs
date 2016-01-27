<?php


namespace TierDocs\Data;

class Introduction implements Examples
{    
    public function getList()
    {
        return [
            'executing' => 'How Tier executes code',
            'dic' => 'Dependency injection',
            'executionControl' => 'Execution control',
            'terminology' => 'Terminology',
            'skeletonApplication' => "Skeleton application"
        ];
    }
}

