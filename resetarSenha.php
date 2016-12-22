<?php
include_once 'class/Updates.class.php';
session_start();

$conexao = new Conexao();
$con = $conexao->conexao();
$atualizar = new Updates($con);
$atualizar->setTabela('usuarios');
$resetaSenha = $atualizar->resetarSenha($_GET['id']);
if($resetaSenha){
   $_SESSION['msg'] = 'Senha resetada com sucesso para 12345';
   header("Location: modulos/administrador/usuarios.php");
}else{
   $_SESSION['msg'] = 'Erro ao resetar senha';
   header("Location: modulos/administrador/usuarios.php");
}
?>
