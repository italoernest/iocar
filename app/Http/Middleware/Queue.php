<?php

namespace App\Http\Middleware;

class Queue{
    /**
    * Fila de middleware a serem executados
    * @var array
    */
    private $middleware = [];

    /**
    * Função de execução do controlador
    * @var Closure
    */
    private $controller;

    /**
    * Argumentos da função do controlador
    * @var array
    */
    private $controllerArgs = [];

    /**
    * Método responsavel por construir a classe de fila de middlewares
    * @param array $middleware
    * @param Closure $controller
    * @param array $controllerArgs
    */
    public function __construct($middleware,$controller,$controllerArgs){
        $this->middleware = $middleware;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
        
        
    }
}