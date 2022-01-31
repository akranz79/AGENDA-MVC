<?php
class ContatoDAO
{
    public function cadastrarContatoDAO($contato)
    {
        //Inclui o arquivo da classe ConexaoDB
        require_once "conexaoDB.php";

        //Cria o objeto da classe ConexaoDB
        $db = new ConexaoDB();

        //Abre a conexao com o DB
        $conexao = $db->abrirConexaoDB();

        //Monta a query (Casdastro)
        $sql = "INSERT INTO contato (nome, sobrenome, email, senha) VALUES (?, ?, ?, ?)";

        //Cria o Prepared Statement
        $stmt = $conexao->prepare($sql);

        //Vincula o parametro que sera inserido no DB
        $stmt->bind_param("ssss", $nome, $sobrenome, $email, $senha);

        //Recebe os valores guardados no objeto
        $nome       = $contato->nome;
        $sobrenome  = $contato->sobrenome;
        $email      = $contato->email;
        $senha      = $contato->senha;
        
        //Executa o Statement
        $cadastrou = $stmt->execute();

        //Fecha o Statement e Conexao
        $stmt->close();
        $db->fecharConexaoDB($conexao);

        return $cadastrou;
    }
}