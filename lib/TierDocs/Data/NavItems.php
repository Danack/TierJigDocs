<?php


namespace TierDocs\Data;

class NavItems implements \IteratorAggregate
{
    private $items = [];
    
    private $syntaxExamples;
    
    private $extendingExamples;
    
    public function __construct(
        Introduction $introduction,
        BasicExamples $basicExamples,
        DesignDecisions $designDecisions
    ) { 
        $this->items[] = new NavItem('/introduction', 'Introduction', $introduction);
        $this->items[] = new NavItem('/examples', 'Examples', $basicExamples);
        $this->items[] = new NavItem('/designDecisions', 'Design decisions', $designDecisions);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
