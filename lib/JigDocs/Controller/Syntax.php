<?php

namespace JigDocs\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;

class Syntax
{
    public function indexPage(TierJig $tierJig)
    {
        $injectionParams = InjectionParams::fromParams([]);
        $injectionParams->alias('TierJig\Data\Examples', '\TierJig\Data\SyntaxExamples');

        return $tierJig->createJigExecutable('pages/syntax/index', $injectionParams);
    }

    public function examplePage(TierJig $tierJig, $example)
    {
        $injectionParams = InjectionParams::fromParams([]);
        $injectionParams->alias('TierJig\Data\Examples', '\TierJig\Data\SyntaxExamples');

        return $tierJig->createJigExecutable("pages/syntax/$example", $injectionParams);
    }
}
