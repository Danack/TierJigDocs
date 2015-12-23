<?php


namespace JigDocs\Data;



class SyntaxExamples implements Examples
{    
    public function getList()
    {
        return [
            'basic' => 'Basic syntax',
            'functions' => 'Functions',
            'ifelse' => 'If else',
            'foreach' => 'Foreach loops',
            'including' => 'Including templates',
            'extend' => 'Extending templates', 
            'inject' => 'Injecting dependencies',
            'comments' => 'Comments',
            'literal' => 'Literal blocks',
        ];
    }
}

