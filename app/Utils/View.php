<?php

namespace App\Utils;


class View{

    /**
     * Variaveis padroes da view
     * @var array
     */
    
    private static $vars = [];

    /**
     * Método responsável por definir os dados iniciais da classes
     * @param array $vars
     */
    public static function init($vars = []){
        self::$vars = $vars; 
    }

    /**
     * Método responsável por retornar o conteúdo de uma view
     * @param string $view
     * @return string
     */
    private static function getContentView($view){
        $file = __DIR__.'/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por retornar o conteúdo renderizado de uma View
     * @param string $view
     * @param array $var (string/numeric)
     * @return string
     */
    public static function render($view, $vars = []) {
        // Conteúdo da view
        $contentView = self::getContentView($view);
    
        // Merge de variáveis da view
        $vars = array_merge(self::$vars, $vars);
    
        // Substituir as variáveis {{variavel}} no conteúdo da view
        foreach ($vars as $key => $value) {
            // Convertendo para string se necessário
            if (is_object($value)) {
                $value = json_encode($value); // Converte o objeto em JSON como fallback
            } elseif (is_array($value)) {
                $value = implode(', ', $value); // Converte arrays em uma string separada por vírgulas
            }
            $contentView = str_replace('{{' . $key . '}}', $value, $contentView);
        }
    
        // Processar as tags condicionais {{#if successMessage}}...{{/if}}
        $contentView = preg_replace_callback('/{{#if (.*?)}}(.*?){{\/if}}/s', function ($matches) use ($vars) {
            $variable = trim($matches[1]); // Variável entre {{#if ...}}
            $content = $matches[2]; // Conteúdo do bloco if
    
            // Verifica se a variável está definida e não está vazia
            if (isset($vars[$variable]) && !empty($vars[$variable])) {
                return $content; // Se a variável estiver definida, exibe o conteúdo
            } else {
                return ''; // Caso contrário, remove o conteúdo
            }
        }, $contentView);
    
        return $contentView;
    }
    
}


//pegar dados
//echo "<pre>";
//print_r($vars);
//echo "</pre>";