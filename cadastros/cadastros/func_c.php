<?php
    include("../conexao/conexao.php");

/////////////////////////////////////// funcoes que nao mudam //////////////////////////////////////

    function retornaConsulta($conexao, $consulta) {
        $retorno = mysqli_query($conexao, $consulta);
    }

    function retornaId ($tabela, $conexao) {
        $retorna_id = "SELECT id FROM $tabela";
        $resultado = resultadoConsulta ($conexao, $retorna_id);
        return $resultado;
    }

    function resultadoConsulta ($conexao, $consulta) {
        $resultado = mysqli_query ($conexao, $consulta);
        while($linha = mysqli_fetch_array($resultado, MYSQLI_BOTH)){
        $id = $linha['id'];
        }
        return $id;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////

    function criarLogin ($email, $senha, $conexao) {
        $login = "insert into `login`(`email`, `senha`) values ('$email','$senha')";
        $retorno = retornaConsulta($conexao, $login);
        $id_login = retornaId("login", $conexao);
        return $id_login;
    }

    function validarEmail($email, $senha, $conexao) {
        $consulta = "SELECT id FROM login WHERE email LIKE '$email' AND senha LIKE $senha";
        $id_login = resultadoConsulta($conexao, $consulta);
        return $id_login;
    }
///----///    
    function criarUsuario($cpf, $nome, $id_login, $conexao) {
        $usuario = "insert into `usuario` (`nome`, `cpf`, `id_login`) values ('$nome','$cpf',$id_login)";
        $retorno = mysqli_query($conexao, $usuario);
        $id_usuario = retornaId("usuario", $conexao);
       
        return $id_usuario;
    }

    function criarTelefone($telefone, $id_usuario, $conexao){
        $telefones = "insert into `telefone` (`telefone`, `id_user`) values ('$telefone', $id_usuario)";
        $retorno = retornaConsulta($conexao, $telefones);
        $id_telefone = retornaId("telefone", $conexao);
        return $id_telefone;
    }

    function loginUsuario ($id_login, $conexao) {
        $consulta = "SELECT u.id FROM usuario AS u INNER JOIN login AS l ON l.id = u.id_login";
        $id_usuario = resultadoConsulta($conexao, $consulta);
        return $id_usuario;
    }
///----///
    function criarEstabelecimento($id_usuario, $cep, $cnpj, $razao_social, $nome, $email, $foto, $numero_endereco, $conexao) {
        $estabelecimento = "insert into `estabelecimento` (`id_user`, `cep`, `cnpj`, `razao_social`, `nome`, `email`, `ft_perfil`, `num_end`) 
        values ($id_usuario, '$cep', '$cnpj', '$razao_social', '$nome', '$email', '$foto', '$numero_endereco')";
        $retorno = retornaConsulta($conexao, $estabelecimento);
        $id_estabelecimento = retornaId("estabelecimento", $conexao);
        return $id_estabelecimento;
    }

    function criarEndereco($id_estabelecimento, $logradouro, $bairro, $id_cidade, $id_uf, $complemento, $conexao){
        $endereco = "insert into `endereco` (`id_estab`, `logradouro`, `bairro`, `id_cidade`, `id_uf`, `complemento`) values 
        ($id_estabelecimento, '$logradouro', '$bairro', $id_cidade, $id_uf, '$complemento')";
        $retorno = retornaConsulta($conexao, $endereco);
        $id_endereco = retornaId("endereco", $conexao);
        return $id_endereco;
    }
///----///
    function consultaCidade ($cidade, $conexao){
        $cidades = "SELECT cidade FROM cidades WHERE cidades.cidade = '$cidade'";
        $retorno = retornaConsulta($conexao, $cidades);
        $id_cidade = retornaId("cidades", $conexao);

        if ($id_cidade == "") {
            $cidades = "insert into `cidades` (`cidade`) values ('$cidade')";
            $id_cidade = retornaId("cidades", $conexao);
            $retorno = retornaConsulta($conexao, $cidades);
        }
        return $id_cidade;
    }

    function consultaEstado ($uf, $conexao){
        $estados = "SELECT uf FROM estado WHERE estado.uf = '$uf'";
        $retorno = retornaConsulta($conexao, $estados);
        $id_uf = retornaId("estado", $conexao);
           
        if ($id_uf == "") {
            $estados = "insert into `estado` (`uf`) values ('$uf')";
            $id_uf = retornaId("estado", $conexao);
            $retorno = retornaConsulta($conexao, $estados);
        }
        return $id_uf;
    }
///-----///
    function criarBanda($nome, $integrantes, $id_estilo, $foto, $email, $id_usuario, $cep, $conexao){
        $bandas = "insert into `banda` (`nome`, `qtd_int`, `id_estilo`, `ft_perfil`, `email`, `id_user`, `cep`) values
        ('$nome', '$integrantes', $id_estilo, '$foto', '$email', $id_usuario, '$cep')";
        $retorno = retornaConsulta($conexao, $bandas);
        $id_banda = retornaId("banda", $conexao);
        return $id_banda;
    }

    function consultaEstilo($estilo, $conexao) {
        $estilos = "SELECT id FROM estilo WHERE estilo LIKE '$estilo'";
        $retorno = retornaConsulta($conexao, $estilos);
        $id_estilo = retornaId("estilo", $conexao);
        return $id_estilo;
    }

    function criarEnderecoArtista($id_artista, $cidade, $estado, $conexao){
        $end_artista = "insert into `end_art` (`id_art`, `cidade`, `estado`) values ($id_artista, '$cidade', '$estado')";
        $retorno = retornaConsulta($conexao, $end_artista);
        $id_end_artista = retornaId("end_art", $conexao);
        return $id_end_artista;
    }
///-----///


//oiiii
?>