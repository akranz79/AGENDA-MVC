<?php
class ContatoService
{
    public function cadastrarContatoService($contato)
    {
        // Verifica se os campos obrigatórios foram preenchidos
        $campo = $this->verificarCampo($contato->nome, "nome");
        if (!$campo['sucesso']) return $campo;
        
        $campo = $this->verificarCampo($contato->sobrenome, "sobrenome");
        if (!$campo['sucesso']) return $campo;
        
        $campo = $this->verificarCampo($contato->email, "email");
        if (!$campo['sucesso']) return $campo;
        
        $campo = $this->verificarCampo($contato->senha, "senha");
        if (!$campo['sucesso']) return $campo;
        
        // Criptografa a senha SHA256
        $contato->senha = $this->criptografarSHA256($contato->senha);

        //Inclui o arquivo contatoDAO
        include_once "ContatoDAO.php";

        //Cria o objeto da classe ContatoDAO
        $dao = new ContatoDAO();

        //Envia os dados para cadastrar no DB
        $cadastrou = $dao->cadastrarContatoDAO($contato);

        if($cadastrou){
        return array (
                "mensagem" => "Cadastro efetuado!", 
                "sucesso" => true
            );
        } else {
            return array (
                "mensagem" => "Erro ao cadastrar!", 
                "campo" => "",
                "sucesso" => false            
            );
        }
    }

    private function criptografarSHA256($senhaInformada)
    {
        //Converte a senha informada para SHA256
        $senhaNova = hash('sha256', $senhaInformada);

        //Informa o Sal e converte para SHA256
        $salt = hash('sha256', "Tequila");

        //Mistura a senha e o Sal
        $senhaNova = hash('sha256', $senhaNova.$salt);
        
        return $senhaNova;
    }

    private function verificarCampo($valorCampo, $nomeCampo)
    {
        // Verifica se o campo foi preenchido
        if(strcmp($valorCampo, "") == 0) {
            return array (
                "mensagem" => "Preencha o campo $nomeCampo", 
                "campo" => "#$nomeCampo",
                "sucesso" => false 
            );
        }
        return array (
            "sucesso" => true
        );
    }
}


