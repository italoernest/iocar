<?php

use \App\Http\Response;
use \App\Controller\Pages;

// ROTA SOBRE
$obRouter -> get('/', [
    'middlewares' => [
        'required-admin-login'
    ],
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

// ROTA SOBRE
$obRouter -> get('/sobre', [
    'middlewares' => [
        'required-admin-login'
    ],
    function(){
        return new Response(200, Pages\About::getAbout());
    }
]);

// ROTA NOVOS VEICULOS
$obRouter -> get('/marca', [
    'middlewares' => [
        'required-admin-login'
    ],
    function(){
        return new Response(200, Pages\Brand::getBrands());
    }
]);

// ROTA NOVOS VEICULOS
$obRouter -> get('/addmarca', [
    'middlewares' => [
        'required-admin-login'
    ],
    function(){
        return new Response(200, Pages\Brand::postBrands());
    }
]);

// ROTA NOVOS VEICULOS
$obRouter -> post('/addmarca', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request){
        //RETORNANDO O CONTEÚDO PARA O FORMULARIO ADDBRANDS
        return new Response(200, Pages\Brand::inserirBrand($request));
    }
]);

// ROTA PARA EXIBIR FORMULÁRIO DE EDIÇÃO
$obRouter->get('/editmarca', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['edit'] ?? null;

        if (!$id || !is_numeric($id)) {
            return new Response(400, Pages\Brand::getErrorPage("ID inválido ou não fornecido!"));
        }

        return new Response(200, Pages\Brand::editBrand($request, $id));
    }
]);

// ROTA PARA PROCESSAR A EDIÇÃO
$obRouter->post('/editmarca', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['edit'] ?? null;

        if (!$id || !is_numeric($id)) {
            return new Response(400, Pages\Brand::getErrorPage("ID inválido ou não fornecido!"));
        }

        return new Response(200, Pages\Brand::editBrand($request, $id));
    }
]);

// ROTA PARA EXCLUIR UMA MARCA
$obRouter->get('/marca/delete', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Pages\Brand::deleteBrand($request));
    }
]);

// ROTA PARA DETALHES DA MARCA
$obRouter->get('/marcadetails', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            return new Response(400, Pages\Brand::getErrorPage("ID inválido ou não fornecido!"));
        }

        return new Response(200, Pages\Brand::getBrandDetails($request, $id));
    }
]);


