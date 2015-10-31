<?php

namespace TierJig\Model;

class InterestingLinks implements \IteratorAggregate
{
    private $links = [];
    
    function __construct()
    {
        $this->links[]  = new Link('http://chat.stackoverflow.com/rooms/11/php', "Room 11");
        $this->links[]  = new Link('http://phpimagick.com', "Imagick by example");
        $this->links[]  = new Link('http://tywkiwdbi.blogspot.co.uk/', "TYWKIWDBI");
    }

    function render()
    {
        $output = '';
        foreach ($this->links as $uri => $description) {
            $output .= sprintf(
                "<a href='%s'> %s</a><br/>",
                $uri,
                $description
            );
        }
        
        return $output;
    }

   
    public function getIterator()
    {
        return new \ArrayIterator($this->links);
    }


}
