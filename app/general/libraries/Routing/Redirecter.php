<?php

namespace app\general\libraries\Routing;

use app\general\libraries\Routing\Route;

/**
 * Class for redirects
 * 
 * @package app\general\libraries\Routing
 */
class Redirecter
{
    public static function addRedirectHeaders(string $url, int $code)
    {
        http_response_code($code);
        header("Location: {$url}");
    }


    public static function redirectFrom(string $from, string $to, int $code) : void
    {
        $fromRoute = new Route($from);

        if ($fromRoute->matches($_SERVER['REQUEST_URI'])) {
            self::addRedirectHeaders($to, $code);
            die;
        }
    }

    /**
     * Redirects to uri without traitling slashes and end the scritp (if it's necessary)
     */
    public static function traitlingSlashRedirect($code) : void
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (preg_match('{[^/]/$}', $uri)) {
            $newUri = rtrim($uri, '/');
            self::addRedirectHeaders($newUri, $code);
            die;
        }
    }
}
