<?php

namespace JigDocs\Controller;

use Tier\JigBridge\TierJig;

class Index
{
    public function renderIntroductionPage(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/introduction');
    }
    
    public function debug(TierJig $tierJig) 
    {
        return $tierJig->createTemplateTier('pages/debug');
    }

    public function debugging(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/debugging');
    }

    public function gettingStarted(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/gettingStarted');
    }
    
    public function filters(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/filters');
    }

    public function renderPluginsPage(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/plugins');
    }

    public function onePageExample(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/onePageExample');
    }

    public function testingTemplates(TierJig $tierJig)
    {
        return $tierJig->createTemplateTier('pages/unitTesting');
    }
}
