<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Alert{
    /**
    * Método responsável por retornar um mensagem de sucesso
    * @param string $message
    * @return string 
    */
    public static function getSuccess($message){
        return View::render('admin/alert/status',[
            'tipo' => 'success',
            'mensagem' => $message
        ]);
    }

    /**
    * Método responsável por retornar um mensagem de Erro
    * @param string $message
    * @return string 
    */
    public static function getError($message){
        return View::render('admin/alert/status',[
            'tipo' => 'danger',
            'mensagem' => $message
        ]);
    }

}