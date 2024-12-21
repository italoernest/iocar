<?php
namespace App\Model\Entity;

class Organization{
    /**
     * ID da Organização
     * @var integer
     */
    public $id = 1;

    /**
     * Nome da organização
     * @var string
     */
    public $name = 'IO Car';

    /**
    * Site da Organização
    * @var string
    */
    public $site = 'https://iosistemas.com.br';

    /**
    * Descrição da Organização
    * @var string
    */
    public $description = 'Lorem ipsum dolor sit amet.';
}