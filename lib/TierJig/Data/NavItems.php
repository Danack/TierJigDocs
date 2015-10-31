<?php


namespace TierJig\Data;

class NavItems implements \IteratorAggregate
{
    private $items = [];
    
    private $syntaxExamples;
    
    private $extendingExamples;
    
    public function __construct(
        SyntaxExamples $syntaxExamples, 
        ExtendingExamples $extendingExamples
    ) { 
        $this->items[] = new NavItem('/', 'Index');
        $this->items[] = new NavItem('/executing', 'Getting started');
        $this->items[] = new NavItem('/syntax', 'Syntax', $syntaxExamples);
        $this->items[] = new NavItem('/extending', 'Extending Jig', $extendingExamples);
        $this->items[] = new NavItem('/testingTemplates', 'Unit testing templates');
        $this->items[] = new NavItem('/onePage', 'One page example');
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
