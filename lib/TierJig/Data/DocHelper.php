<?php

namespace TierJig\Data;

use TierJig\TierJigException;

class DocHelper {
    protected $exampleEntries = array (
  0 => 'O:23:"TierJig\\TemplateExample":5:{s:4:"info";s:18:"syntax includeFile";s:5:"lines";s:27:"This is the included file.
";s:4:"file";s:40:"/syntax/includeFile/includedFile.php.tpl";s:9:"startLine";i:2;s:7:"endLine";i:4;}',
  1 => 'O:23:"TierJig\\TemplateExample":5:{s:4:"info";s:18:"syntax includeFile";s:5:"lines";s:117:"This is a template that includes another file.
{include file=\'syntax/includeFile/includedFile\'}
Include test passed.
";s:4:"file";s:33:"/syntax/includeFile/index.php.tpl";s:9:"startLine";i:2;s:7:"endLine";i:6;}',
);
    protected $category;
    protected $example;
    protected $categoryCase;
    protected $exampleCase;
    

    
}