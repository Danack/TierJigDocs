<?php


namespace TierDocs\Data;

class NavItems implements \IteratorAggregate
{
    private $items = [];
    
    private $syntaxExamples;
    
    private $extendingExamples;
    
    public function __construct(
        TierExamples $syntaxExamples 
//        ExtendingExamples $extendingExamples
    ) { 
        $this->items[] = new NavItem('/', 'Index');
        $this->items[] = new NavItem('/executing', 'How Tier works');
        $this->items[] = new NavItem('/dic', 'Dependency injection');
        $this->items[] = new NavItem('/executionControl', 'Execution control');


        $this->items[] = new NavItem('/examples', 'Examples', $syntaxExamples);
        //$this->items[] = new NavItem('/onePage', 'One page example');
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
