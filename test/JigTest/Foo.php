<?php


namespace JigTest;

class Foo
{
    private $value;
    
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}
