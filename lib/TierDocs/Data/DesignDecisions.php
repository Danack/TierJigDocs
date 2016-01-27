<?php


namespace TierDocs\Data;

class DesignDecisions implements Examples
{    
    public function getList()
    {
        return [
            'bodyVsPSR7' => 'PSR7 vs Body',
            'noEvents' => 'Events not needed',
        ];
    }
}

