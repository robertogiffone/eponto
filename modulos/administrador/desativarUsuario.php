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
$desativarUsuario = $objAtualizar->desativarUsuario($_GET['id']);
//echo $desativarUsuario;
if ($desativarUsuario){
    //$_SESSION['msg'] = 'Usuário desativado com sucesso';
    header('Location:usuarios.php?inativo=1');
}else{
    //$_SESSION['msg'] = 'Erro ao tentar desativar usuário';
    header('Location:usuarios.php?inativo=0');
}

/* Código para deletar o usuário, mas não irei utilizar porque vou utilizar chave estrangeira e só apaga o usuário se apagar todos os pontos, caso eu coloque para deletar em cascata 
include_once '../../class/Delets.class.php';
$deletar = new Delets('localhost', 'root', '', 'eponto', 'usuarios');
$deletar->deletaUsuarioPorId($_GET['id']);
if ($deletar){
    $_SESSION['msg'] = 'Usuário deletado com sucesso';
    header('Location:usuarios.php');
    //echo 'Usuário deletado com sucesso';
}else{
    $_SESSION['msg'] = 'Erro ao deletar';
    header('Location:usuarios.php');
    //echo 'Erro ao deletar';
}*/
?>
<a href="usuarios.php"> Voltar </a>