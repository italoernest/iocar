<?php

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogout{

    /**
    * Método responsável por executar o middleware
    * @param Request $request
    * @param Closure $next
    * @return Response
    */
    
    public function handle($request, $next){
        //VERIFICA SE O USUÁRIO ESTÁ LOGADO
        if(SessionAdminLogin::isLogged()){
            //REDIRECIONA O USUÁRIO PARA A  HOME DO ADMIN
            //$request->getRouter()->redirect('/admin');
            //REDIRECIONA O USUÁRIO PARA A TELA PRINCIPAL
            $request->getRouter()->redirect('/'); //Habilitar essa para cair na Dashboard
        }

        //CONTINUA A EXECUÇÃO
        return $next($request);
    }

}