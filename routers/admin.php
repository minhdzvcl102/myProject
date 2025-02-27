<?php

use App\Controllers\Admin\BannerController;
use App\Controllers\Admin\CategoriesController;
use App\Controllers\Admin\CommentController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\UserController;


$router->mount('/admin', function () use ($router) {

    // param la /admin/
    $router->get('/', DashboardController::class . '@index');
    $router->get('/users', UserController::class . '@index');
    $router->get('/users/create', UserController::class . '@create');
    $router->post('/users/store', UserController::class . '@store');
    $router->get('/users/show/{id}', UserController::class . '@show');
    $router->get('/users/edit/{id}', UserController::class . '@edit');
    $router->post('/users/update/{id}', UserController::class . '@update');
    $router->get('/users/delete/{id}', UserController::class . '@delete');
    
    // Router Categories 
    $router->get('/categories', CategoriesController::class . '@index');
    $router->get('/categories/create', CategoriesController::class . '@create');
    $router->post('/categories/store', CategoriesController::class . '@store');
    $router->get('/categories/show/{id}', CategoriesController::class . '@show');
    $router->get('/categories/edit/{id}', CategoriesController::class . '@edit');
    $router->post('/categories/update/{id}', CategoriesController::class . '@update');
    $router->get('/categories/delete/{id}', CategoriesController::class . '@delete');

     // Router Banners 
     $router->get('/banners', BannerController::class . '@index');
     $router->get('/banners/create', BannerController::class . '@create');
     $router->post('/banners/store', BannerController::class . '@store');
     $router->get('/banners/show/{id}', BannerController::class . '@show');
     $router->get('/banners/edit/{id}', BannerController::class . '@edit');
     $router->post('/banners/update/{id}', BannerController::class . '@update');
     $router->get('/banners/delete/{id}', BannerController::class . '@delete');

      // Router Product 
      $router->get('/product', ProductController::class . '@index');
      $router->get('/product/create', ProductController::class . '@create');
      $router->post('/product/store', ProductController::class . '@store');
      $router->get('/product/show/{id}', ProductController::class . '@show');
      $router->get('/product/edit/{id}', ProductController::class . '@edit');
      $router->post('/product/update/{id}', ProductController::class . '@update');
      $router->get('/product/delete/{id}', ProductController::class . '@delete');

      // Router Coment 
      $router->get('/comment/edit/{id}/{id_product}', CommentController::class . '@edit');

   
});
