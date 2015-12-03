<?php


namespace JigDocs\Data;

class NavItem
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
    public function renderChild()
    {
        if ($this->examples == null) {
            return '';
        }
        $output = "<li>";
        $output .= $this->examples->renderList();
        $output .= "</li>";
        
        return $output;
    }
}
