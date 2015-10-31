<?php


namespace TierJig\Data;



class SyntaxExamples extends Examples
{
    private $docHelper;
    
    function __construct(DocHelper $docHelper)
    {
        $this->docHelper = $docHelper;
    }
    
    public static function getList()
    {
        return [
            'basic' => 'Basic syntax',
            'functions' => 'Functions',
            'ifelse' => 'If else',
            'foreach' => 'Foreach loops',
            'including' => 'Including templates',
            'extend' => 'Extending templates', 
            'inject' => 'Injecting dependencies',
            'comment' => 'Comment blocks',
            'literal' => 'Literal blocks',
        ];
    }
    
    public function renderList()
    {
        $output = "<ul class='nav'>";
        foreach (self::getList() as $example => $description) {
            $output .= "<li>";
            $output .= sprintf(
                "<a href='/syntax/%s'>%s</a>",
                $example,
                $description
            );
            $output .= "</li>";
        }
        
        $output .= "</ul>";
        
        return $output;
    }
}

