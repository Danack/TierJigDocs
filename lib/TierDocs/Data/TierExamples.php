<?php


namespace TierDocs\Data;

class TierExamples extends Examples
{
    private $docHelper;
    
    function __construct()
    {
    }
    
    public static function getList()
    {
        return [
            ['caching', 'Caching content', 'Full caching description' ],
            ['configuration', 'App configuration', 'Getting application configuation into an application'],
            ['contexts', 'Contexts', 'Contexts for application security' ],
        ];
    }
    
    public function renderList()
    {
        $output = "<ul class='nav'>";
        foreach (self::getList() as $example) {
            list($example, $description, $fullDescription) = $example;
            
            $output .= "<li>";
            $output .= sprintf(
                "<a href='/examples/%s'>%s</a>",
                $example,
                $description
            );
            $output .= "</li>";
        }
        
        $output .= "</ul>";
        
        return $output;
    }
}

