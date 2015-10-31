<?php


namespace TierJig\Controller;

use Tier\VariableMap\VariableMap;

use Room11\HTTP\Body\JsonBody;

class UserSetting
{
   public function updateSetting(VariableMap $variableMap)
   {
       $settingData = $variableMap->getVariable('setting');
       
       $data = [];
       $data['result'] = 'OK';
       
       return new JsonBody($data);
   }
}
