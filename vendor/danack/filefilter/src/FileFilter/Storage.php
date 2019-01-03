<?php


namespace FileFilter;

interface Storage
{
    public function downloadFile($storageFilename, $localFilename);
}
