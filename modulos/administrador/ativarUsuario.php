<?php
include_once '../../class/Updates.class.php';
include_once '../../class/Usuario.class.php';
session_start();
if ( !isset($_SESSION['logado']) ){ //Caso não esteja logado
    header('Location:../../index.php');
}else{
    $usuario = $_SESSION['logado'];
}

if( $usuario->getPrivilegio() == 'Comum' ){ //Para tratar que usuário comum não tenha acesso a página de administrador
    header('Location:../logado/logado.php');
}

//Tenho que repensar para fazer isso com metodo post
if( !isset($_GET['id']) ){ //Caso não exista um id na url
    header('Location:../logado/usuarios.php');
}

$conexao = new Conexao();
$con = $conexao->conexao();
$objAtualizar = new Updates($con);
$objAtualizar->setTabela('usuarios');
//$objAtualizar->setCampos(''); //Não tem utilidade
$ativarUsuario = $objAtualizar->ativarUsuario($_GET['id']);
//echo $desativarUsuario;
if ($ativarUsuario){
    //$_SESSION['msg'] = 'Usuário ativado com sucesso';
    header('Location:usuarios.php?ativo=1');
}else{
    //$_SESSION['msg'] = 'Erro ao tentar ativar usuário';
    header('Location:usuarios.php?ativo=0');
}
?>
