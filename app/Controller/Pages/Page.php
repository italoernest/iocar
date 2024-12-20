<?php 

namespace App\Controller\Pages;

use \App\Utils\View;

class Page{

    /**
     * Método responsável por renderizar o topo da página
     * @return string
     */
    private static function getHeader(){
        return View::render('pages/header');
    }
    
    /**
    * Método responsável por renderizar o topo da página
    * @return string
    */
    private static function getNavbar(){
        return View::render('pages/navbar');
    }

    /**
    * Método responsável por renderizar o topo da página
    * @return string
    */
    private static function getSidebar(){
        return View::render('pages/sidebar');
    }

    /**
    * Método responsável por renderizar o wrapper
    * @return string
    */
    private static function getWrapper(){
        return View::render('pages/wrapper');
    }

    /**
     * Método responsável por renderizar o rodapé da página
     * @return string
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }

    /**
     * Método responsável por retornar o conteúdo da nossa Pagina
     * @return string
     */
    public static function getPage($title,$content){
        return View::render('pages/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'navbar' => self::getNavbar(),
            'sidebar'=> self::getSidebar(),
            'wrapper' => self::getWrapper(),
            'content' => $content,
            'footer' => self::getFooter(),
        ]);
    }
}
