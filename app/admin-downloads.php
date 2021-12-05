<?php

use app\general\libraries\Routing\Router;
use app\general\utilities\RouteBase\AdminDownloadsHandler;
use app\general\utilities\RouteBase\UriPrefix;


$router = new Router();

$router->add('GET', '/subscribers.csv', function() {
    AdminDownloadsHandler::handleRequest('subscribers', 'csvTable');
});


$router->addNotFoundHandler(function() {
    http_response_code(404);
    echo 'File not found :(';
});

try {
    $router->routeUri(UriPrefix::getInstance()->getClippedAdminDownloadsRoute());
}
catch (Exception $err) {
    http_response_code(500);
    echo "There was some error on the server :(\n";
    echo $err->getMessage();
    throw $err;
}
