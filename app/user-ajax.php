<?php

error_reporting(0);

use app\general\libraries\Routing\Router;
use app\general\utilities\RouteBase\UriPrefix;
use app\general\utilities\RouteBase\UserAjaxHandler;


$router = new Router();

$router->add('POST', '/subscribers/add', function() {
    UserAjaxHandler::handleRequest('subscribers', 'add');
});


$router->addNotFoundHandler(function() {
    http_response_code(404);
});

try {
    $router->routeUri(UriPrefix::getInstance()->getClippedUserAjaxRoute());
}
catch(Error | Exception $err) {
    http_response_code(500);
    json_encode([
        'message' => $err->getMessage(),
    ]);
    throw $err;
}
