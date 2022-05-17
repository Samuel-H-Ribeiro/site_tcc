<?php
    //include("../../conexao/conexao.php");
    function criarRedeSocial ($id_artista, $tipo_rede_social, $link, $conexao) {
        $retorna_tipo = "SELECT id FROM tp_rede WHERE rede_social LIKE '$tipo_rede_social'"; 
        $id_tipo = resultadoConsulta($conexao, $retorna_tipo);
        return $id_tipo;
    } 

?>