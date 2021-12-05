<?php

ini_set('display_errors', '0');


require_once __DIR__ . '/app/general/libraries/Debug/write.php';

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/consts.php';
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';


use app\general\utilities\RouteBase\UriPrefix;


$uriRoute = UriPrefix::getInstance();

if ($uriRoute->isAdminPagesRoute()) {
    $indexFile = 'admin-pages.php';
}
else if ($uriRoute->isAdminAjaxRoute()) {
    $indexFile = 'admin-ajax.php';
}
else if ($uriRoute->isAdminDownloadsRoute()) {
    $indexFile = 'admin-downloads.php';
}
else if ($uriRoute->isUserAjaxRoute()) {
    $indexFile = 'user-ajax.php';
}
else {
    $indexFile = 'user-pages.php';
}


require_once __DIR__ . "/app/{$indexFile}";
