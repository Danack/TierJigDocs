<?php

namespace TierJig;

class TemplateExample
{
    public $info;
    public $lines;
    public $file;
    public $startLine;
    public $endLine = null;

    public function __construct($info, $file, $startLine)
    {
        $this->info = $info;
        $this->lines = '';
        $this->file = $file;
        $this->startLine = $startLine;
    }

    /**
     * @param $endLine
     */
    public function setEndLine($endLine)
    {
        $this->endLine = $endLine;
    }

    /**
     * @return mixed
     */
    public function getStartLine()
    {
        return $this->startLine;
    }

    /**
     * @return null
     */
    public function getEndLine()
    {
        return $this->endLine;
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return mixed
     */
    public function getLines()
    {
        return $this->lines;
    }

    public function appendLine($line)
    {
        $this->lines .= $line;
    }
}
