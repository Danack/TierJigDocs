<?php


namespace JigDocs\Data;



class SyntaxExamples extends Examples
{    
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
            'comment' => 'Comments',
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

