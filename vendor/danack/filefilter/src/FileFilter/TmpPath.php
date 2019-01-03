<?php


namespace FileFilter;

class TmpPath
{
    private $path;

    public function __construct($tmpPath)
    {
        $this->path = $tmpPath;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
