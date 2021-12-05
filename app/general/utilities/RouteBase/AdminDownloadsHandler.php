<?php

namespace app\general\utilities\RouteBase;

/**
 * @package app\general\utilities\RouteBase
 */
class AdminDownloadsHandler
{
    public static function handleRequest(string $controller, string $action) : void
    {
        $controller = self::makeControllerName($controller);
        $action     = self::makeActionName($action);

        $obj = new $controller();
        $obj->$action();
    }


    private static function makeControllerName(string $controller) : string
    {
        return
            'app\\admin\\controllers\\' . ucfirst($controller) . '\\'
            . ucfirst($controller) . 'DownloadsController';
    }


    private static function makeActionName(string $action) : string
    {
        return $action;
    }
}
