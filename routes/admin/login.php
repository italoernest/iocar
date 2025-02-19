<?php

use \App\Http\Response;
use \App\Controller\Admin;

// ROTA ADMIN
$obRouter -> get('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request){
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

// ROTA ADMIN (POST)
$obRouter -> post('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request){
        return new Response(200, Admin\Login::setLogin($request));
    }
]);

// ROTA LOGOUT
$obRouter -> get('/admin/logout', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        return new Response(200, Admin\Login::setLogout($request));
    }
]);