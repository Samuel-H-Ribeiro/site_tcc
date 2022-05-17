<?php

class login {
    public $email;
    private $senha;

    function login () {
        if ($login == "criar") {
            $login = "insert into `login`(`email`, `senha`) values ('$email','$senha')";
        $retorno = retornaConsulta($conexao, $login);
        $id_login = retornaId("login", $conexao);
        return $id_login;
        }
       if ($login == "entrar") {
        $consulta = "SELECT id FROM login WHERE email LIKE '$email' AND senha LIKE $senha";
        $id_login = resultadoConsulta($conexao, $consulta);
        return $id_login;
       }
    }
}
