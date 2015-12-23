<?php


namespace JigDocs\Data;

class NavItems implements \IteratorAggregate
{
    private $items = [];

    public function __construct(
        AdvancedExamples $advancedExamples,
        SyntaxExamples $syntaxExamples, 
        ExtendingExamples $extendingExamples
    ) { 
        $this->items[] = new NavItem('/', 'Introduction');
        $this->items[] = new NavItem('/gettingStarted', 'Getting started');
        $this->items[] = new NavItem('/syntax', 'Syntax', $syntaxExamples);
        $this->items[] = new NavItem('/filters', 'Filters');
        $this->items[] = new NavItem('/extending', 'Extending Jig', $extendingExamples);
        $this->items[] = new NavItem('/advanced', 'Advanced topics  ', $advancedExamples);

        $this->items[] = new NavItem('/debugging', 'Debugging');
        $this->items[] = new NavItem('/onePageExample', 'One page example');
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}
