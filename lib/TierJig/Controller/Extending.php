<?php

namespace TierJig\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;

class Extending
{
    public function indexPage(TierJig $tierJig)
    {
        $injectionParams = InjectionParams::fromParams([]);
        $injectionParams->alias('TierJig\Data\Examples', 'TierJig\Data\ExtendingExamples');

        return $tierJig->createTemplateTier('pages/extending/index', $injectionParams);
    }

    public function examplePage(TierJig $tierJig, $example)
    {
        $injectionParams = InjectionParams::fromParams([]);
        $injectionParams->alias('TierJig\Data\Examples', '\TierJig\Data\ExtendingExamples');

        return $tierJig->createTemplateTier("pages/extending/$example", $injectionParams);
    }
}