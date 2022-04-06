<?php

declare(strict_types=1);

namespace Core;

class Router
{
    public function getRouteInfo(): array
    {
        $allowedControllers = ['users', 'api', 'news'];

        if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/') {
            // user/register/12
            $pathInfo = strtolower(trim($_SERVER['PATH_INFO'], '/'));
            //
            $pathInfo = explode('/', $pathInfo);
            // [user register 12]
            $slug = isset($pathInfo[0]) ? $pathInfo[0] : null;
            if (in_array($slug, $allowedControllers)) {
                $controller = $slug;
                $method = isset($pathInfo[1]) ? $pathInfo[1] : 'index';
//                if(isset($pathInfo[1])){
//                    $method = $pathInfo[1];
//                }else{
//                    $method = 'index';
//                }
                $param = isset($pathInfo[2]) ? $pathInfo[2] : null;
            } else {
                $controller = 'news';
                $method = 'show';
                $param = $slug;
            }
        } else {
            $controller = 'home';
            $method = 'index';
            $param = null;
        }
        return [$controller, $method, $param];
    }
}