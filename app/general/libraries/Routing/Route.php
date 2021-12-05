<?php

namespace app\general\libraries\Routing;

use app\general\libraries\Routing\RouteSpecialItem;

/**
 * Class for working with url path
 * 
 * @package app\general\libraries\Routing
 * 
 * @internal
 */
class Route
{
    /** @var string[] */
    private $routeItems;

    /**
     * @param $route Uri path. It can cantain varibales for ex. 'panel/orders/{order_id}'
     */
    public function __construct(string $urlPath)
    {
        $this->routeItems = self::getSplitedRoute($urlPath);
    }


    public function matches(string $urlPath) : bool
    {
        $realRoute = self::getSplitedRoute($urlPath);

        if (count($realRoute) !== count($this->routeItems)) {
            return false;
        }

        foreach ($this->routeItems as $i => $routeItem) {
            $realRouteItem = $realRoute[$i];

            if (RouteSpecialItem::isItemSpecial($routeItem)) {
                $routeSpecialItem = new RouteSpecialItem($routeItem);

                if (!$routeSpecialItem->matches($realRouteItem)) {
                    return false;
                }
            }
            else {
                if ($realRoute[$i] !== $realRouteItem) {
                    return false;
                }
            }
        }

        return true;
    }


    public function getVariables(string $urlPath) : array
    {
        if (!$this->matches($urlPath)) {
            return [];
        }

        $result = [];

        $realRoute = self::getSplitedRoute($urlPath);

        foreach ($this->routeItems as $i => $routeItem) {
            $realRouteItem  = $realRoute[$i];

            if (!RouteSpecialItem::isItemSpecial($routeItem)) {
                continue;
            }

            $specialItem = new RouteSpecialItem($routeItem);
            $variableName = $specialItem->getName();
            $result[$variableName] = $realRouteItem;
        }

        return $result;
    }


    private static function getSplitedRoute(string $urlPath) : array
    {
        if ($urlPath[0] === '/') {
            $urlPath = substr($urlPath, 1);
        }

        if ($urlPath === '') {
            return [];
        }

        return explode('/', $urlPath);
    }
}
