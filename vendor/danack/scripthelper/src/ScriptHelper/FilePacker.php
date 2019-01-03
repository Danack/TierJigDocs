<?php

namespace ScriptHelper;

interface FilePacker
{
    public function getHeaders();
    public function getFinalFilename(array $filesToPack, $extension);
    public function pack($jsIncludeArray, $appendLine, $extension);
}
