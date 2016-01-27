<?php

namespace TierDocs\Data;

class NavItem implements \IteratorAggregate
{
    private $path;
    private $description;
    
    /** @var Examples */
    private $examples;
    
    public function __construct($path, $description, Examples $examples = null)
    {
        $this->path = $path;
        $this->description = $description;
        $this->examples = $examples;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Examples
     */
    public function getExamples()
    {
        return $this->examples;
    }

    
    
    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }
    
    public function render()
    {
        return sprintf(
            "<a href='%s'>%s</a>",
            $this->getPath(),
            $this->getDescription()
        );
    }

    public function getIterator()
    {
        if ($this->examples) {
            return new \ArrayIterator($this->examples->getList());
        }

        return new \ArrayIterator([]);
    }

    public function renderChild()
    {
        if ($this->examples == null) {
            return '';
        }
        $output = "<li class='subItem'>";

        $output .= "<ul class='nav'>";
        foreach ($this->examples->getList() as $example => $description) {
            $output .= "<li>";
            $output .= sprintf(
                "<a href='%s/%s'>%s</a>",
                $this->path,
                $example,
                $description
            );
            $output .= "</li>";
        }
        $output .= "</ul>";
        $output .= "</li>";

        return $output;
    }
}
