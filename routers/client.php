<?php

use App\Controllers\Admin\UserController as AdminUserController;
use App\Controllers\Client\DetailController;
use App\Controllers\Client\HomeController;
use App\Controllers\Client\UserController;
use App\Models\CartUser;

// home 
$router->get("/", HomeController::class . '@index');
$router->get("/listProduct(/(\w+))?", HomeController::class . '@listProduct');
$router->get("/detailProduct/{id}/{category_id}", HomeController::class . '@detailProduct');
//coment
$router->post("/comment/store/{product_id}", DetailController::class . '@store');
//infor
$router->get("/showInfor/{user_id}", fn: UserController::class . '@showInforUser');
$router->post("/user/update/{idUser}", fn: AdminUserController::class . '@update');
$router->post("/user/updatePass/{idUser}", fn: UserController::class . '@updatePass');
$router->get("/user/orderDetail/{oderId}", fn: UserController::class . '@orderDetail');
// Cart 
$router->get("/addProduct/{product_id}", fn: UserController::class . '@addProductCard');
$router->get("/delete/cartProduct/{idCart}", fn: UserController::class . '@deleteItemCart');
// Pay
$router->get("/formCheckOut", fn: UserController::class . '@formCheckOut');
$router->post("/checkout", fn: UserController::class . '@checkout');