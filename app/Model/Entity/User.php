<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User{

         /**
     * ID da marca
     * @var integer $id
     */
    public $id;
    /**
     * Nome do usuario
     * @var string $username
     */
    public $username;
    /**
     * Email do usuario
     * @var string $email
     */
    public $email;
    /**
     * Senha do usuario
     * @var string $password
     */
    public $password;
    /**
     * Status do usuario
     * @var string $status
     */
    public $status;
    /**
     * Data de criação do usuario
     * @var string $created_at
     */
    public $created_at;
     /**
     * Data de atualização do usuario
     * @var string $updated_at
     */
    public $updated_at;

    /**
     * Método responsável por retornar um usuario com base em seu email
     * @param string $email
     * @return User
     */
    public static function getUserByEmail($email){
        return (new Database('users'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }
}