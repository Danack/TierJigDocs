<?php

namespace TierDocs\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;
use Tier\VariableMap\VariableMap;

use ASM\Session;

class Index
{
    public function renderIndexPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/index');
    }
    
    
    public function renderExecutingPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/executing');
    }

    public function renderDicPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/dic');
    }
    
    
    public function renderExecutionControlPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/executionControl');
    }
    

    
    public function renderExamplesPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/examples/index');
    }
    
    public function renderCachingPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/examples/cachingTier');
    }
    
    public function renderConfigurationPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/examples/configuration');
    }
    
    public function renderContextsPage(TierJig $tierJig)
    {
        return $tierJig->createJigExecutable('pages/examples/contexts');
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

        return $tierJig->createJigExecutable('pages/debug');
    }
}
