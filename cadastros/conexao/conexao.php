<?php
require_once ("config.php");
$conexao = mysqli_connect($host, $usuario, $senha, $nome);

if (!$conexao){
    echo ("Conexão falhou".mysqli_connect_error());
}

?>