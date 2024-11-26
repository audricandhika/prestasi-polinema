<?php

namespace app\core;

class RouteNode
{
    public array $children = [];
    public array $handler = [];
    public array $params = [];

    public function __construct()
    {
        $this->children = [];
        $this->handler = [];
        $this->params = [];
    }
}