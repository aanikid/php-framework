<?php

use App\Controllers\AboutController;
use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Routes\Router;


$router = new Router();

$router->get('/', HomeController::class);
$router->get('/about',AboutController::class);

$router->get('/login', [UserController::class, 'login']);
$router->post('/login', [UserController::class, 'login']);

$router->addNotFoundHandler(function () {echo 'Not Found';});

$router->run();