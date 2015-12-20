<?php


namespace JigDocs\Model;

class UserInfo
{
    private $name;
    private $twitterHandle;
    
    public function __construct($name, $twitterHandle)
    {
        $this->name = $name;
        $this->twitterHandle = $twitterHandle;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTwitterHandle()
    {
        return $this->twitterHandle;
    }    
}
