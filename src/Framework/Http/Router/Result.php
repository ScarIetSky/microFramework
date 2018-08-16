<?php

namespace Framework\Http\Router;

class Result
{
    private $name;
    private $handler;
    private $attribute;

    public function __construct($name, $handler, array $attribute)
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attribute = $attribute;
    }

    public function getName() :string
    {
        return $this->name;
    }

    public function getHandler()
    {
        return $this->handler;
    }

    public function getAttributes() :array
    {
        return $this->attribute;
    }
}