<?php

namespace FileFilter;

class YuiCompressorFilterFactory
{
    /**
     * @var YuiCompressorPath
     */
    private $yuiCommpressorPath;

    /**
     * @param FileFilter $previousFilter
     * @param $destFile
     * @param YuiCompressorPath $yuiCommpressorPath
     * @param int $filterUpdateMode
     */
    public function __construct(YuiCompressorPath $yuiCommpressorPath)
    {
        $this->yuiCommpressorPath = $yuiCommpressorPath;
    }

    public function create(
        FileFilter $previousFilter,
        $destFile,
        $filterUpdateMode = FileFilter::CHECK_EXISTS_MTIME_AND_PREVIOUS
    ) {
        return new YuiCompressorFilter(
            $previousFilter,
            $destFile,
            $this->yuiCommpressorPath,
            $filterUpdateMode
        );
    }
}
