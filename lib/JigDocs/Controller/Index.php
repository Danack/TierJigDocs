<?php

namespace JigDocs\Controller;

use Tier\JigBridge\TierJig;

class Index
{
    //Keep this one to make debugging easy. 
    public function debug(TierJig $tierJig) 
    {
        return $tierJig->createJigExecutable('pages/debug');
    }
}
