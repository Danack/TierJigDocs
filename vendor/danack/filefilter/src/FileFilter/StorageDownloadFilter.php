<?php


namespace FileFilter;

use FileFilter\Storage;
use FileFilter\File;

class StorageDownloadFilter extends FileFilter
{
    /**
     * @var \FileFilter\Storage
     */
    private $storage;
    
    private $storageFilename;

    public function     __construct(
        Storage $storage,
        File $destFile,
        $storageFilename,
        $filterUpdateMode = FileFilter::CHECK_EXISTS_AND_PREVIOUS
    ) {
        $this->storage = $storage;
        $this->filterUpdateMode = $filterUpdateMode;
        $this->destFile = $destFile;
        $this->storageFilename = $storageFilename;
    }

    public function filter($tmpName)
    {
        $this->storage->downloadFile($this->storageFilename, $tmpName);
    }
    
    public function process()
    {
        if ($this->requiresUpdate() == true) {
            if ($this->previousFilter != null) {
                $this->previousFilter->process();
            }

            $this->filter($this->destFile->getPath());
        }
    }

    public function srcModified()
    {
        $destPath = $this->destFile->getPath();

        if (@file_exists($destPath) == false) {
            return true;
        }

        if (@filesize($destPath) == 0) {
            unlink($destPath);
            return true;
        }

        return false;
    }
}
