<?php

use app\general\libraries\Database\exceptions\DbConnectionException;

use app\general\libraries\Routing\Router;
use app\general\libraries\Routing\Redirecter;
use app\general\utilities\RouteBase\AdminPagesHandler;
use app\general\utilities\RouteBase\UriPrefix;


Redirecter::redirectFrom('/admin/subscribers', '/admin/subscribers/page/1', 301);


$router = new Router();

$router->add('GET', "/subscribers/page/{page_num|(^[1-9][0-9]{0,}$)}", function($variables) {
    $paginationPage = (int)$variables['page_num'];

    AdminPagesHandler::handlePage('subscribers', 'index', $paginationPage);
});


$router->addNotFoundHandler(function() {
    http_response_code(404);
    echo 'Admin panel 404 page';
});

try {
    $router->routeUri(UriPrefix::getInstance()->getClippedAdminPageRoute());
}
catch(DbConnectionException $err) {
    http_response_code(500);
    echo 'Admin panel 500 page <br>';
    echo 'Bad database connection: ' . $err->getMessage();
    throw $err;
}
catch (Exception | Error $err) {
    http_response_code(500);
    echo 'Admin panel 500 page <br>';
    echo 'Unknow error';
    throw $err;
}

