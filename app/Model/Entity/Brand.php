<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Brand{
     /**
     * ID da marca
     * @var integer
     */
    public $id;
     /**
     * Nome da marca
     * @var string
     */
    public $name;
     /**
     * Logo da organização
     * @var string (armazenado na pasta)
     */
    public $logo;
     /**
     * Data de criação da marca
     * @var string
     */
    public $created_at;
     /**
     * Data de atualização da marca
     * @var string
     */
    public $updated_at;
  
    /**
     * Método responsável por cadastrar a instancia atual no banco de dados
     * @return boolean
     */
    public function cadastrar(){
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = $this->created_at;

        //INSERI A MARCA NO BANCO DE DADOS
        $this->id = (new Database('brands'))->insert([
            'name' => $this->name,
            'logo' => $this->logo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ]);

        return true;
    }

     /**
     * Método responsável por retornar as Marcas
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $limit 
     * @return PDOStatement
     */
    public static function getBrands($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('brands')) -> select($where, $order, $limit, $fields);
    }
    
    public static function getByName($name) {
        $brandData = (new Database('brands'))->select('name = "' . $name . '"')->fetchObject(self::class);

        return $brandData ?: null;
    }

    public static function getBrandById($id) {
        return (new Database('brands'))->select('id = ' . $id)->fetchObject(self::class);
    }

    public function atualizar() {
        return (new Database('brands'))->update('id = ' . $this->id, [
            'name' => $this->name,
            'logo' => $this->logo,
            'updated_at' => $this->updated_at
        ]);
    }

    public function excluir() {
        return (new Database('brands'))->delete('id = ' . $this->id);
    }
}