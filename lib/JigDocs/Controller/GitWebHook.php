<?php

namespace JigDocs\Controller;

use Tier\VariableMap\VariableMap;

class GitWebHook
{

    //Host: localhost:4567
    //X-Github-Delivery: 72d3162e-cc78-11e3-81ab-4c9367dc0958
    //User-Agent: GitHub-Hookshot/044aadd
    //Content-Type: application/json
    //Content-Length: 6615
    //X-Github-Event: issues
    
    public function event(VariableMap $variableMap)
    {
        $payload = $variableMap->getVariable('payload');

        $filehandle = @fopen(__DIR__."/test.txt", "a+");
        
        if ($filehandle === false) {
            throw new \Exception("Failed to open logging file.");
        }
        
        fwrite($filehandle, "Payload at ".time()."\n");
        fwrite($filehandle, var_export($payload, true));
        fwrite($filehandle, "\n\n");
        
        fclose($filehandle);
        
        echo "OK";
        exit(0);
    }
}
