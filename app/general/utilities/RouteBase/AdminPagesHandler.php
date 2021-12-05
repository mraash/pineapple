<?php

namespace app\general\utilities\RouteBase;

/**
 * @package app\general\utilities\RouteBase
 */
class AdminPagesHandler
{
    public static function handlePage(string $controller, string $action, $argument = null) : void
    {
        $controller = self::makeControllerName($controller);
        $method     = self::makeActionName($action);

        $obj = new $controller();
        $obj->$method($argument);
    }


    private static function makeControllerName(string $controller) : string
    {
        $namespace = 'app\\admin\\controllers\\' . ucfirst($controller);
        $className = ucfirst($controller) . 'PagesController';

        return $namespace . '\\' . $className;
    }


    private static function makeActionName($action) : string
    {
        return $action . 'Page';
    }
}
