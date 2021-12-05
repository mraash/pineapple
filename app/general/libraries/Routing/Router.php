<?php

namespace app\general\libraries\Routing;

use app\general\libraries\Routing\Route;

/**
 * Class for routing
 * 
 * It just saves the callback for the url of the path and then calls it. So it knows
 * nothing about the structure of the controller folders and all this
 * 
 * @package app\general\libraries\Routing
 */
class Router
{
    /** 
     * @var array[] $route = [
     *    'method'    => (array)     Array of http method
     *    'uriString' => (string)    Url path
     *    'handler'   => (callable)  Callback
     * ] 
     */
    private $routes = [];

    /** @var callback */
    private $notFoundHandler;

    /**
     * Adds callback to url path.
     * 
     * @param string $httpMethod  HTTP method. It is case sensitive. If you need to
     *   add multiple methods use '|' to separate them
     * 
     * @param string $rotue  Url path. You can specify the first slash, you can omit it.
     *   It also can contain special items that are wrapped in {}.
     *   Exaple: '/constroller/action/{varName}'
     *           '/constroller/action/{varName|(regex)}'
     * 
     * @param callback $handler  Callback that will be called if route matches. It will
     *   be called with one wrgument - an associative array of variables of special
     *   route items
     */
    public function add(string $httpMethod, string $route, callable $handler) : void
    {
        $methods = explode('|', $httpMethod);

        array_push($this->routes, [
            'method'    => $methods,
            'uriString' => $route,
            'handler'   => $handler,
        ]);
    }


    /**
     * Adds callback for situations when ->routeUri() will not found active route
     */
    public function addNotFoundHandler(callable $handler) : void
    {
        if (is_array($handler)) {
            $handler = $this->makeHandlerFromArray($handler);
        }

        $this->notFoundHandler = $handler;
    }

    /**
     * Starts routing
     * 
     * Iterates over saved routes. If there is active route will call that route handler
     * else will call 'notFound' handler (if it is set)
     * 
     * @param string $requestUri Url path that you need to route. You can specify the first
     *   slash, you can omit it.
     */
    public function routeUri(string $requestUri) : void
    {
        $method  = $_SERVER['REQUEST_METHOD'];
        $urlPath = parse_url($requestUri, PHP_URL_PATH);

        foreach ($this->routes as $item) {
            $routeUri    = $item['uriString'];
            $routeMethod = $item['method'];

            if (!in_array($method, $routeMethod)) {
                continue;
            }

            $route = new Route($routeUri);

            if (!$route->matches($urlPath)) {
                continue;
            }
            
            $handler      = $item['handler'];
            $variablesArr = $route->getVariables($urlPath);

            $handler($variablesArr);

            return;
        }

        if (is_callable($this->notFoundHandler)) {
            $handler = $this->notFoundHandler;
            $handler();
        }
    }
}
