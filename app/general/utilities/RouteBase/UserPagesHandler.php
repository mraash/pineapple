<?php

namespace app\general\utilities\RouteBase;

/**
 * @package app\general\utilities\RouteBase
 */
class UserPagesHandler
{
    public static function handlePage(string $controller, string $action, $argument = null) : void
    {
        $controller = self::makeControllerName($controller);
        $method     = self::makeActionName($action);

        $obj = new $controller();
        $obj->$method($argument);
    }


    protected static function makeControllerName(string $controller) : string
    {
        return
            'app\\user\\controllers\\' . ucfirst($controller) . '\\'
            . ucfirst($controller) . 'PagesController';
    }


    protected static function makeActionName($action) : string
    {
        return $action . 'Page';
    }
}
