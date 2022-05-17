<?php
    include("conexao.php");
    include("../cadastros/func_c.php");
    include("../pages/banda/pagebanda.php");

    //variaveis banda
    $nome_banda = "pixote";
    $integrantes = 5;
    $estilo = "Pagode";
    $foto_banda = "pixote.img";
    $email_banda = "pixote@pixote.com";
    $cep = "13163190";

    //variaveis estabelecimento
    $criar_estab = true;
    $cep = "13167344";
    $cnpj = "124354657656";
    $razao_social = "biofloraltda";
    $nome_estab = "bioflora";
    $email = "bioflora@gmail.com";
    $foto_estab = "https:/bioflora.img";
    $num_end = "247";

    //variaveis de validacao
    $validacao = "";

    //variaveis endereco
    $cidade = "Artur Nogueira";
    $uf = "SP";
    $logradouro = "joao gazola";
    $bairro = "planalto";
    $complemento = "perto de algum lugar";

    //variaveis botao cadastrar estabelecimento / banda.
    $criar_estab = true;
    $criar_banda = false;

    //variaveis login
    $email = "patricia@gmail.com";
    $senha = "4234456";

    //variaveis usuario
    $id_login = "";
    $nome_usuario = "Patricia";
    $cpf = "98673435446";
    $telefone = "9854353466";

    //botao cadastrar do view
    //$c_usuario = $_POST['c_usuario'];
    $criar_usuario = true;
    $criar_login = false;
    //criar login ou validar
    if ($criar_login == true) {
        $id_login = criarLogin($email, $senha, $conexao);
    } 
    if ($criar_login == false) {
        $id_login = validarEmail($email, $senha, $conexao);
    }
    
    if($validacao != 0) {
        if ($criar_usuario == true) {
            $id_usuario = criarUsuario($cpf, $nome_usuario, $id_login, $conexao);
            $id_telefone = criarTelefone($telefone, $id_usuario, $conexao);
        } else {
            if($criar_usuario == false) {
                $id_usuario = loginUsuario($validacao, $conexao);
            }
        }
   }

   //criar a funcao de selecionar estabelecimento ou banda.


    //criar estabelecimento
    if ($id_usuario != 0) {
        if ($criar_estab == true) {
            $id_estabelecimento = criarEstabelecimento($id_usuario, $cep, $cnpj, $razao_social, $nome_estab, $email, $foto_estab, $num_end, $conexao);
            if ($id_estabelecimento != 0) {
                //criar endereco
                $id_cidade = consultaCidade($cidade, $conexao);
                $id_uf = consultaEstado($uf, $conexao);
                if ($id_cidade != 0 && $id_uf != 0) {
                    $id_endereco = criarEndereco($id_estabelecimento, $logradouro, $bairro, $id_cidade, $id_uf, $complemento, $conexao);
                }   
            }
        } 
    } 

    //criar banda

    if ($id_usuario != 0) {
        if ($criar_banda == true) {
            $id_estilo = consultaEstilo($estilo, $conexao);
            $id_banda = criarBanda($nome_banda, $integrantes, $id_estilo, $foto_banda, $email_banda, $id_usuario, $cep, $conexao);
            $id_cidade = consultaCidade($cidade, $conexao);
            $id_uf = consultaEstado($uf, $conexao);
            $id_end_artista = criarEnderecoArtista($id_banda, $id_cidade, $id_uf, $conexao);
        }
    }    
?>