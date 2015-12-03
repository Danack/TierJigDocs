<?php


namespace Site\Model;

class Link
{
    private $url;
    private $description;

    public function __construct($url, $description)
    {
        $this->url = $url;
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    
}
