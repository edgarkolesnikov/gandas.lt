<?php

namespace Core;

class Launcher
{
    public function start($routeInfo)
    {
        list($controller, $method, $param) = $routeInfo;
    }
}