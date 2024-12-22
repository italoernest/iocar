<?php

use \App\Http\Response;
use \App\Controller\Pages;

// ROTA SOBRE
$obRouter -> get('/', [
    function(){
        return new Response(200, Pages\Home::getHome());
    }
]);

// ROTA SOBRE
$obRouter -> get('/sobre', [
    function(){
        return new Response(200, Pages\About::getAbout());
    }
]);

// ROTA NOVOS VEICULOS
$obRouter -> get('/marca', [
    function(){
        return new Response(200, Pages\Brand::getBrands());
    }
]);

// ROTA NOVOS VEICULOS
$obRouter -> get('/addmarca', [
    function(){
        return new Response(200, Pages\Brand::postBrands());
    }
]);

// ROTA NOVOS VEICULOS
$obRouter -> post('/addmarca', [
    function($request){
        //RETORNANDO O CONTEÚDO PARA O FORMULARIO ADDBRANDS
        return new Response(200, Pages\Brand::inserirBrand($request));
    }
]);

// ROTA PARA EXIBIR FORMULÁRIO DE EDIÇÃO
$obRouter->get('/editmarca', [
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
    function($request) {
        return new Response(200, Pages\Brand::deleteBrand($request));
    }
]);

// ROTA PARA DETALHES DA MARCA
$obRouter->get('/marcadetails', [
    function($request) {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            return new Response(400, Pages\Brand::getErrorPage("ID inválido ou não fornecido!"));
        }

        return new Response(200, Pages\Brand::getBrandDetails($request, $id));
    }
]);


