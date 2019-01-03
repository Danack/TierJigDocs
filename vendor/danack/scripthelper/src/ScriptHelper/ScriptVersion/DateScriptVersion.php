<?php

namespace ScriptHelper\ScriptVersion;

use ScriptHelper\ScriptVersion;

class DateScriptVersion implements ScriptVersion
{
    private $version;

    public function __construct()
    {
        $this->version = date('Y_m_d');
    }

    public function getVersion()
    {
        return $this->version;
    }
}