<?php 

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Organization;

class Home extends Page{
    /**
     * Método responsável por retornar o conteúdo da nossa Home
     * @return string
     */
    public static function getHome(){
        //ORGANIZAÇÃO
        $obOrganization = new Organization;

        //VIEW DA HOME
        $content = View::render('pages/home',[
            'name' => $obOrganization->name
            //RETORNA A VIEW DA PAGINA 
        ]);
        return parent::getPage("IO - CAR - HOME", $content, 'dashboard');
    }
}
