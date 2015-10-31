<?php

namespace TierJig\Controller;

use Tier\JigBridge\TierJig;
use Tier\InjectionParams;
use Tier\VariableMap\VariableMap;

use ASM\SessionManager;
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

        $data[] = time();
        $session->save();
        

        return $tierJig->createTemplateTier('pages/debug');
    }
    
    public function renderPluginsPage(TierJig $tierJig)
    {
        
        
        return $tierJig->createTemplateTier('pages/plugins');
    }
    
    
    public function onePageExample(TierJig $tierJig)
    {
//        $injectionParams = InjectionParams::fromParams(['pageTitle' => "Imagick demos"]);
//        $injectionParams->alias('ImagickDemo\Navigation\Nav', 'ImagickDemo\Navigation\NullNav');

        return $tierJig->createTemplateTier('pages/onePageExample');
    }
    
    
    public function testingTemplates(TierJig $tierJig)
    {
//        $injectionParams = InjectionParams::fromParams(['pageTitle' => "Imagick demos"]);
//        $injectionParams->alias('ImagickDemo\Navigation\Nav', 'ImagickDemo\Navigation\NullNav');

        return $tierJig->createTemplateTier('pages/unitTesting');
    }
}
