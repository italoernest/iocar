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
        $results = EntityBrand::getBrands(null, 'name ASC');

        //RENDERIZA O ITEM 
        while ($obBrand = $results->fetchObject(EntityBrand::class)){
            $itens .= View::render('pages/brand/item',[
                'id' => $obBrand->id,
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
    public static function getBrands($page = 1, $limit = 10) {
        // Calcular o offset com base na página
        $offset = ($page - 1) * $limit;
    
        // Obtém as marcas com limite e offset
        $brands = self::getBrandItems($limit, $offset);
    
        // Passa as marcas e o nome da página para a view
        $content = View::render('pages/brands', [
            'itens' => $brands,  // Passa as instâncias de marcas para a view
            'name' => 'Marca de Veículos',  // Passa o nome da página para a view
            'page' => $page,     // Passa a página atual para a view
            'limit' => $limit    // Passa o limite de registros por página
        ]);
    
        return parent::getPage("IO - Modelos de Veículos", $content);
    }
    

    public static function postBrands($successMessage = null, $errorMessage = null) {
        // Passa as mensagens para a view
        $content = View::render('pages/add_brands', [
            'successMessage' => $successMessage, // Passa a mensagem de sucesso para a view
            'errorMessage' => $errorMessage,     // Passa a mensagem de erro para a view
        ]);
    
        // Retorna a página completa com o conteúdo
        return parent::getPage("IO - Novos Modelos de Veículos", $content);
    }

     /**
     * Método responsável por cadastrar uma marca
     * @param Request $request
     * @return string
     */
    public static function inserirBrand($request) {
        // Dados do POST
        $postVars = $request->getPostVars();
    
        // Inicialize as variáveis
        $successMessage = null;
        $errorMessage = null;
    
        // Verifique se o nome da marca já existe no banco de dados
        $existingBrand = EntityBrand::getByName($postVars['name']);
        if ($existingBrand) {
            $errorMessage = 'Erro: Já existe uma marca com esse nome.';
        } else {
            // Verifique se o arquivo logo foi enviado
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                // Obtenha a extensão do arquivo da imagem
                $fileInfo = pathinfo($_FILES['logo']['name']); // Pega as informações do arquivo (nome e extensão)
                $extension = $fileInfo['extension']; // Extensão do arquivo (ex: jpg, png)
    
                // Gera um nome único para o arquivo
                $uniqueName = uniqid('logo_') . '-' . time() . '.' . $extension; // Nome único com prefixo, timestamp e extensão
    
                // Define o caminho para salvar a imagem com o novo nome
                $logoPath = 'uploads/logos/' . $uniqueName;
    
                // Verifica se o arquivo foi movido com sucesso
                if (!move_uploaded_file($_FILES['logo']['tmp_name'], $logoPath)) {
                    $errorMessage = 'Erro ao salvar a imagem do logo.';
                }
            } else {
                $logoPath = null;  // Caso o arquivo logo não tenha sido enviado
            }
    
            // Nova instância de Brand
            if (empty($errorMessage)) {
                $obBrand = new EntityBrand;
                $obBrand->name = $postVars['name'];
                $obBrand->logo = $logoPath;  // Atribui o caminho da logo
                $obBrand->cadastrar();
    
                $successMessage = 'Marca cadastrada com sucesso!';
            }
        }
    
        // Passa a mensagem de sucesso ou erro para a view
        return self::postBrands($successMessage, $errorMessage);
    }
    

    /**
    * Método responsável por mostrar o erro de editar a marca
    * @param Request $request
    * @return string
    */
    public static function getErrorPage($message) {
        return View::render('pages/error', [
            'error' => $message
        ]);
    }

    public static function editBrand($request, $id) {
        // Obtém os dados da marca pelo ID
        $obBrand = EntityBrand::getBrandById($id);

        // Verifica se a marca foi encontrada
        if (!$obBrand) {
            return self::getErrorPage("Marca não encontrada!");
        }

        // Inicializa variáveis
        $successMessage = null;
        $errorMessage = null;

        // Verifica se o método é POST (salvar alterações)
        if ($request->getHttpMethod() == 'POST') {
            $postVars = $request->getPostVars();

            // Atualiza o nome
            $obBrand->name = $postVars['name'] ?? $obBrand->name;

            // Atualiza o logo, se enviado
            if (isset($_FILES['logo']) && $_FILES['logo']['error'] == 0) {
                $fileInfo = pathinfo($_FILES['logo']['name']);
                $extension = $fileInfo['extension'];
                $uniqueName = uniqid('logo_') . '-' . time() . '.' . $extension;
                $logoPath = 'uploads/logos/' . $uniqueName;

                if (move_uploaded_file($_FILES['logo']['tmp_name'], $logoPath)) {
                    $obBrand->logo = $logoPath;
                } else {
                    $errorMessage = 'Erro ao salvar o novo logo.';
                }
            }

            // Atualiza os dados no banco
            if (!$errorMessage) {
                $obBrand->updated_at = date('Y-m-d H:i:s');
                if ($obBrand->atualizar()) {
                    $successMessage = 'Marca atualizada com sucesso!';
                } else {
                    $errorMessage = 'Erro ao atualizar a marca no banco de dados.';
                }
            }
        }

        // Renderiza o formulário de edição
        $content = View::render('pages/edit_brands', [
            'id' => $obBrand->id,
            'name' => $obBrand->name,
            'logo' => $obBrand->logo,
            'successMessage' => $successMessage,
            'errorMessage' => $errorMessage
        ]);

        return parent::getPage("Editar Marca de Veículo", $content);
    }   

    public static function deleteBrand($request) {
        // Obtém os parâmetros da query string
        $queryParams = $request->getQueryParams();
        $id = $queryParams['delete'] ?? null;
    
        // Verifica se o ID é válido
        if (!$id || !is_numeric($id)) {
            return self::getErrorPage("ID inválido ou não fornecido!");
        }
    
        // Obtém a marca pelo ID
        $obBrand = EntityBrand::getBrandById($id);
    
        // Verifica se a marca foi encontrada
        if (!$obBrand) {
            return self::getErrorPage("Marca não encontrada!");
        }
    
        // Exclui o registro no banco de dados
        if (!$obBrand->excluir()) {
            return self::getErrorPage("Erro ao excluir a marca!");
        }
    
        // Redireciona para a página de listagem com mensagem de sucesso
        header('Location: ' . URL . '/marca?success=Marca excluída com sucesso!');
        exit;
    }

    /**
     * Método responsável por exibir os detalhes de uma marca
     * @param Request $request
     * @param int $id
     * @return string
     */
    public static function getBrandDetails($request, $id) {
        // Obtém os dados da marca pelo ID
        $obBrand = EntityBrand::getBrandById($id);

        // Verifica se a marca foi encontrada
        if (!$obBrand) {
            return self::getErrorPage("Marca não encontrada!");
        }

        // Renderiza os detalhes da marca
        $content = View::render('pages/brand_details', [
            'id' => $obBrand->id,
            'name' => $obBrand->name,
            'logo' => $obBrand->logo,
            'created_at' => date('d/m/Y H:i:s', strtotime($obBrand->created_at)),
            'updated_at' => date('d/m/Y H:i:s', strtotime($obBrand->updated_at))
        ]);

        return parent::getPage("Detalhes da Marca", $content);
    }
}
