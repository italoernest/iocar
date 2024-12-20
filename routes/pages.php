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
