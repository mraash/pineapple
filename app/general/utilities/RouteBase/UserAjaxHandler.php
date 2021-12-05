<?php

namespace app\general\utilities\RouteBase;

/**
 * @package app\general\utilities\RouteBase
 */
class UserAjaxHandler
{
    public static function handleRequest(string $controller, string $action) : void
    {
        $controller = self::makeControllerName($controller);
        $method     = self::makeActionName($action);

        $obj = new $controller();
        $obj->$method();
    }


    private static function makeControllerName(string $controller) : string
    {
        $namespace = 'app\\user\\controllers\\' . ucfirst($controller);
        $className = ucfirst($controller) . 'AjaxController';

        return $namespace . '\\' . $className;
    }


    private static function makeActionName($action) : string
    {
        return $action;
    }
}
