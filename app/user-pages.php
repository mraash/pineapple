<?php

use app\general\libraries\Database\exceptions\DbConnectionException;

use app\general\libraries\Routing\Router;
use app\general\libraries\Routing\Redirecter;
use app\general\utilities\RouteBase\UserPagesHandler;


$router = new Router();

$router->add('GET|POST', '/', function() {
    UserPagesHandler::handlePage('content', 'index');
});


$router->addNotFoundHandler(function() {
    http_response_code(404);
    echo 'Users panel 404 page';
});

try {
    $router->routeUri($_SERVER['REQUEST_URI']);
}
catch(DbConnectionException $err) {
    http_response_code(500);
    echo 'User panel 500 page <br>';
    echo 'Bad database connection';
    throw $err;
}
catch (Exception | Error $err) {
    http_response_code(500);
    echo 'User panel 500 page <br>';
    echo 'Unknow error';
    throw $err;
}
