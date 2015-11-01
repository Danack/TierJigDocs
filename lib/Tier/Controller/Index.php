<?php

namespace Tier\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;
use Tier\VariableMap\VariableMap;

use ASM\Session;

class Index
{
    public function renderIndexPage(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/index');
    }

    public function debug(TierJig $tierJig, VariableMap $variableMap, Session $session)
    {
        $data = &$session->getData();

        $value = $variableMap->getVariable('data', false);
        if ($value !== false && strlen(trim($value)) != 0) {
            $data[] = $value;
        }
        $value = $variableMap->getVariable('submit', false);
        if ($value !== false && strcmp($value, "Clear") === 0) {
            $session->setData([]);
        }

        $session->save();

        return $tierJig->createTemplateTier('pages/debug');
    }
}