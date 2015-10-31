<?php


namespace TierJig\Data;

class ExtendingExamples extends Examples
{
    private $docHelper;
    
    function __construct(DocHelper $docHelper)
    {
        $this->docHelper = $docHelper;
    }
    
    public static function getList()
    {
        return [
            'functions' => 'Functions',
            'blocks' => 'Blocks',
            'filters' => 'Filters',
            'builtinfilters' => 'Builtin filters',
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

