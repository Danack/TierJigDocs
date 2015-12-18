<?php

namespace JigDocs\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;

class Extending
{
    public function indexPage(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/extending/index');
    }

    public function plugins(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/extending/plugins');
    }

    public function compileTimeBlocks(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/extending/compileTimeBlocks');
    }

    public function examplePage(TierJig $tierJig, $example)
    {
        $injectionParams = InjectionParams::fromParams([]);
        $injectionParams->alias('TierJig\Data\Examples', '\TierJig\Data\ExtendingExamples');

        return $tierJig->createTemplateTier("pages/extending/$example", $injectionParams);
    }
}
