<?php


namespace JigDocs\Data;

class ExtendingExamples extends Examples
{
    //private $docHelper;
    
    function __construct()
    {
        //$this->docHelper = $docHelper;
    }
    
    public static function getList()
    {
        return [
            'plugins' => 'Plugin overview',
            'functions' => 'Plugin functions',
            'blocks' => 'Plugin blocks',
            'filters' => 'Plugin filters',
            //'builtinfilters' => 'Builtin filters',
            'compileTimeBlocks' => 'Compile blocks',
        ];
    }
    
    public function renderList()
    {
        $output = "<ul class='nav'>";
        foreach (self::getList() as $example => $description) {
            $output .= "<li>";
            $output .= sprintf(
                "<a href='/extending/%s'>%s</a>",
                $example,
                $description
            );
            $output .= "</li>";
        }
        
        $output .= "</ul>";
        
        return $output;
    }


}

