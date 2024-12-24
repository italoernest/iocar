<?php

use \App\Http\Response;
use \App\Controller\Admin;

//ROTA DE LISTAGEM DE USUÁRIOS
$obRouter->get('admin/users',[
    'middlewares' => [
        'required-admin-login'
    ],
    function(){
        return new Response(200, Admin\User::getUsers($request));
    }
]);

//ROTA DE CADASTRADO DE UM NOVO USUÁRIOS
$obRouter->get('admin/users/new',[
    'middlewares' => [
        'required-admin-login'
    ],
    function(){
        return new Response(200, Admin\User::getNewUsers($request));
    }
]);