<?php

namespace App\Http\Middleware;

class Maintenance{

    /**
    * Método responsável por executar o middleware
    * @param Request $request
    * @param Closure $next
    * @return Response
    */
    
    public function handle($request, $next){
        //VERIFICA O ESTADO DE MANUTENÇÃO DA PÁGINA
        if(getenv('MAINTENANCE') == 'true'){
            throw new \Exception("Sistema em manutenção. Tente novamente mais tarde",200);
        }

        //EXEXUTA O PROXIMO NÍVEL DO MIDDLEWARE
        return $next($request);
    }

}