<?php

require __DIR__.'/includes/app.php';

use \App\Http\Router;

//INICIA O ROUTER
$obRouter= new Router(URL);

//INCLUI DAS ROTAS DE PAGINAS
include __DIR__.'/routes/pages.php';

//INCLUI DAS ROTAS DO PAINEL
include __DIR__.'/routes/admin.php';

//IMPRIMI O RESPONSE DA ROTA
$obRouter->run()
         ->sendResponse();