<?php

namespace App\Http;

class Request{
    /**
    * Método HTTP da requisição
    * @var string
    */
    private $httpMethod;

    /**
    * URI da página
    * @var string
    */
    private $uri;

    /**
     * Parametros da URL ($_GET)
     * @var array
     */
    private $queryParams = [];

    /**
     * Variaveis recebidas no POST da página ($_POST)
     * @var array
     */
    private $postVars = [];

    /**
     * cabeçalho da requisição
     * @var array
     */
    private $headers = [];

    /**
     * Instancia do router
     * @var array
     */
    private $router = [];
    /**
     * Construtor da classe
     */
        public function __construct($router){
        $this -> router = $router;
        $this -> queryParams = $_GET ?? [];
        $this -> postVars = $_POST ?? [];
        $this -> headers = getallheaders();
        $this -> httpMethod = $_SERVER['REQUEST_METHOD'] ?? '';
        $this -> setUri();
    }

    /**
    * Método responsável por definir a URI
    */
    private function setUri(){
        //URI COMPLETA (COM GETS)
        $this -> uri = $_SERVER['REQUEST_URI'] ?? '';

        //REMOVE GETS DA URI
        $xURI = explode('?', $this->uri);
        $this->uri = $xURI[0];
    }

    /**
    * Método responsável por retornar a instancia de router
    * @return string
    */
    public function getRouter(){
        return $this->router;
    }

    /**
    * Método responsável por retornar o método HTTP da requisição
    * @return string
    */
    public function getHttpMethod(){
        return $this -> httpMethod;
    }

    /**
    * Método responsável por retornar URI da requisição
    * @return string
    */
    public function getUri(){
        return $this -> uri;
    }

    /**
    * Método responsável por retornar os headers da requisição
    * @return array
    */
    public function getHeaders(){
        return $this -> headers;
    }

    /**
    * Método responsável por retornar os parametros da URL da requisição
    * @return array
    */
    public function getQueryParams(){
        return $this -> queryParams;
    }

        /**
    * Método responsável por retornar as variaveis POST da requisição
    * @return array
    */
    public function getPostVars(){
        return $this -> postVars;
    }
    
}