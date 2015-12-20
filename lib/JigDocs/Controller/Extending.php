<?php

namespace JigDocs\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;

class Extending
{

    public function examplePage(TierJig $tierJig, $example)
    {
        $injectionParams = InjectionParams::fromParams([]);
        $injectionParams->alias('TierJig\Data\Examples', '\TierJig\Data\ExtendingExamples');

        return $tierJig->createJigExecutable("pages/extending/$example", $injectionParams);
    }
}
