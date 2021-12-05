<?php

use app\general\libraries\Routing\Router;
use app\general\utilities\RouteBase\UriPrefix;
use app\general\models\Subscribers\SubscribersManager;


$router = new Router();

$router->add('DELETE', '/subscribers', function($variables) {
    $model = SubscribersManager::getInstance();

    $requestBody = file_get_contents('php://input');
    $listOfId    = json_decode($requestBody, true);

    $model->delete($listOfId);
});


$router->addNotFoundHandler(function() {
    http_response_code(404);
});


try {
    $router->routeUri(UriPrefix::getInstance()->getClippedAdminAjaxRoute());
}
catch (Exception | Error $err) {
    http_response_code(500);
    throw $err;
}