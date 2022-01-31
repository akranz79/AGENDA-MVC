<?php
//Inicia a sessao
session_start();


//1 CAdastrar
if (isset($_POST['cadastrar'])){
    cadastrarContato();
   
//2 
}

//FUNCTIONS
function cadastrarContato()
{
    //Inclui os arquivos (Model)
    include_once "../Model/Contato.php";
    include_once "../Model/ContatoService.php";

    //Retorno do JSON (validação)
    header('Content-Type: application/json');

    //Guarda os dados informados no formulario
    $email     = $_POST['email'];
    $senha     = $_POST['senha'];
    $nome      = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    
    
    // Cria os objetos das classes Contato e ContatoService
    $contato = new Contato();
    $service = new ContatoService();

    //Preenche o objeto com os dados informados
    $contato->email      = $email;
    $contato->senha      = $senha;
    $contato->nome       = $nome;
    $contato->sobrenome  = $sobrenome;
    
    //Envia o objeto para efetuar o cadastro
    $response = $service->cadastrarContatoService($contato);    

    //Verifica o tupo de retorno
    if ($response['sucesso']){
        //mostra a mensagem de sucessso
        print json_encode(array(
            'mensagem' => $response['mensagem'],
            'codigo' => 1));
        exit();
              
    
    } else {
        //mostra a mensagem de Erro
        print json_encode(array(
            'mensagem' => $response['mensagem'],
            'campo' => $response['campo'],
            'codigo' => 0));
        exit();
    }
}
var_dump($email);