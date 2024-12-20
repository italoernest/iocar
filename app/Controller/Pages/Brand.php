<?php 

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Brand as EntityBrand;

class Brand extends Page{

     /**
     * Método responsável por obter a renderização dos itens da Marca para pagina
     * @return string
     */
    private static function getBrandItems(){
        //MARCAS
        $itens = '';

        //RESULTADOS DA PÁGINA
        $results = EntityBrand::getBrands(null, 'id DESC');

        //RENDERIZA O ITEM 
        while ($obBrand = $results->fetchObject(EntityBrand::class)){
            $itens .= View::render('pages/brand/item',[
               'name' => $obBrand->name,
               'logo' => $obBrand->logo,
               'Criado em:' => $obBrand->logo,
               'Atualizado em:' => $obBrand->logo 
            ]);
        }

        //RETORNA AS MARCAS
        return $itens;
    }

    /**
     * Método responsável por retornar o conteúdo de Novos Veículos
     * @return string
     */
    public static function getBrands(){

        //VIEW DA NOVOS VEÍCULOS
        $content = View::render('pages/brands',[
            'itens' => self::getBrandItems()
        ]);
        return parent::getPage("IO - Modelos de Veículos", $content);
    }

    public static function postBrands(){

        //VIEW DA NOVOS VEÍCULOS
        $content = View::render('pages/add_brands',[
            
        ]);
        return parent::getPage("IO - Novos Modelos de Veículos", $content);
    }

     /**
     * Método responsável por cadastrar uma marca
     * @param Request $request
     * @return string
     */
    public static function inserirBrand($request){
        //DADOS DO POST
        $postVars = $request->getPostVars();

        //NOVA INSTANCIA DE DEPOIMENTO
        $obBrand = new EntityBrand;
        $obBrand->name = $postVars['name'];
        $obBrand->logo = $postVars['logo'];
        $obBrand->cadastrar();

        return self::postBrands();
    }
}
