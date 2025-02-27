<?php

use App\Controllers\Auth\AuthController;

$router->get('/auth/showForm', AuthController::class . '@index');
$router->post('/auth/login', AuthController::class . '@login');
$router->post('/auth/register', AuthController::class . '@register');
$router->get('/auth/logout', AuthController::class . '@logout');
$router->before('GET|POST', '/.*', function() {
    middleware_auth();
});
