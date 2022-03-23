<?php

namespace app\core;

use app\routes\Routes;
use app\support\RequestType;
use app\support\Uri;

class ControllerParams
{
    public function get($router)
    {
        $uri = Uri::get();
        $method = RequestType::get();
        $routes = Routes::get()[$method];

        $router = array_search($router, $routes);

        $explodeUri = explode('/', $uri);
        $explodeRouter = explode('/', $router);

        $params = [];

        foreach ($explodeRouter as $index => $routerSegment) {
            if ($routerSegment !== $explodeUri[$index]) {
                $params[$index] = $explodeUri[$index];
            }
        }

        return array_values($params);
    }
}