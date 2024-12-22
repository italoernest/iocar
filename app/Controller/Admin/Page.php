<?php

namespace App\Controller\Admin;

use \App\Utils\View;

class Page{
    /**
     * Método responsável por renderizar o topo da página
     * @return string
     */
    private static function getHeader(){
        return View::render('admin/header');
    }

    /**
     * Método responsável por renderizar o rodapé da página
     * @return string
     */
    private static function getFooter(){
        return View::render('admin/footer');
    }

    /**
     * Método responsável por retornar o conteúdo (view) da estrutura generica de página do painel
     * @param string $title
     * @param string $content
     * @return string 
     */
    public static function getPage($title,$content){
        return View::render('admin/page',[
            'title' => $title,    
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter(),
        ]);
    }
}
