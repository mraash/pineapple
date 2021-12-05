<?php

namespace app\general\utilities\RouteBase;

use app\general\libraries\HelperTraits\Singleton;

/**
 * @package app\general\utilities\RouteBase
 */
class UriPrefix
{
    use Singleton;

    /** @var string */
    private $uriFirstItem;


    private function __construct()
    {
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        $splited = explode('/', $uri);

        $this->uriFirstItem = $splited[0];
    }


    // ----------------------------
    // ------- User pages
    public function isUserPagesRoute() : bool
    {
        return !$this->isUserAjaxRoute() && !$this->isAdminPagesRoute();
    }


    // ----------------------------
    // ------- User ajax
    public function isUserAjaxRoute() : bool
    {
        return $this->uriFirstItem === URI_PREFIX_USER_AJAX;
    }


    public function getClippedUserAjaxRoute() : string
    {
        return $this->getClippedRoute(URI_PREFIX_USER_AJAX);
    }


    // ----------------------------
    // ------- Admin pages
    public function isAdminPagesRoute() : bool
    {
        return $this->uriFirstItem === URI_PREFIX_ADMIN_PAGES;
    }


    public function getClippedAdminPageRoute() : string
    {
        return $this->getClippedRoute(URI_PREFIX_ADMIN_PAGES);
    }


    // ----------------------------
    // ------- Admin ajax
    public function isAdminAjaxRoute() : bool
    {
        return $this->uriFirstItem === URI_PREFIX_ADMIN_AJAX;
    }


    public function getClippedAdminAjaxRoute() : string
    {
        return $this->getClippedRoute(URI_PREFIX_ADMIN_AJAX);
    }


    // ----------------------------
    // ------- Admin downloads
    public function isAdminDownloadsRoute() : bool
    {
        return $this->uriFirstItem === URI_PREFIX_ADMIN_DOWNLOADS;
    }


    public function getClippedAdminDownloadsRoute() : string
    {
        return $this->getClippedRoute(URI_PREFIX_ADMIN_DOWNLOADS);
    }


    // ----------------------------
    private function getClippedRoute(string $uriPrefix) : string
    {
        $regex = '{^/' . $uriPrefix . '}';

        $result = preg_replace($regex, '', $_SERVER['REQUEST_URI']);

        if ($result === '') {
            $result = '/';
        }

        return $result;
    }
}
