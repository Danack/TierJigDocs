<?php


namespace JigDocs\Data;

class ExtendingExamples implements Examples
{
    public function getList()
    {
        return [
            'plugins' => 'Plugin overview',
            'functions' => 'Plugin functions',
            'blocks' => 'Plugin blocks',
            'filters' => 'Plugin filters',
            'compileTimeBlocks' => 'Compile blocks',
        ];
    }
}

