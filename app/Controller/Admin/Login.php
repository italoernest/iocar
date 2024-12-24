<?php

namespace App\Controller\Admin;

use \App\Model\Entity\User;
use \App\Utils\View;
use \App\Session\Admin\Login as SessionAdminLogin;

class Login extends Page{
    /**
    * Método responsável por retornar a renderização da página de login
    * @param Request $request
    * @param string $errorMessage
    * @return string 
    */
    public static function getLogin($request, $errorMessage = null){
        //STATUS

        $status = !is_null($errorMessage) ? View::render('admin/login/status',[
            'mensagem' => $errorMessage
        ]) : '' ;

        //CONTEUDO DA PAGINA DE LOGIN
        $content = View::render('admin/login',[
            'status' => $status
        ]);

        //RETORNA A PÁGINA COMPLETA
        return parent::getPage('IO Car - Admin', $content);
    }

    /**
    * Método responsável por definir o login do Usuario
    * @param Request $request
    * @return string 
    */
    public static function setLogin($request){
        //POST VAR
        $postVars = $request->getPostvars();
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';

        //BUSCA O USUARIO PELO E-MAIL
        $obUser = User::getUserByEmail($email);
        if(!$obUser instanceof User){
            return self::getLogin($request, 'E-mail ou senha inválidos');
        }

        //VERIFICA A SENHA DO USUARIO
        if(!password_verify($password, $obUser->password)){
            return self::getLogin($request, 'E-mail ou senha inválidos');
        }

        //CRIA SESSION DE LOGIN
        SessionAdminLogin::login($obUser);

        //REDIRECIONA O USUÁRIO PARA A  HOME DO ADMIN
        //$request->getRouter()->redirect('/admin');
        //REDIRECIONA O USUÁRIO PARA A TELA PRINCIPAL
        $request->getRouter()->redirect('/'); //Habilitar essa para cair na Dashboard
    }

    /**
    * Método responsável por deslogar o usuário
    * @param Request $request
    */
    public static function setLogout($request){
        //DESTROI A SESSÃO DE LOGIN
        SessionAdminLogin::logout();

        //REDIRECIONA O USUARIO PARA A TELA DE LOGIN
        $request->getRouter()->redirect('/admin/login');
    }
}
