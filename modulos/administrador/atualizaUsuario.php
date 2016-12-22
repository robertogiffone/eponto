<?php
include_once '../../class/Updates.class.php';
session_start();
$conexao = new Conexao();
$con = $conexao->conexao();
//$atualizar = new Updates('localhost', 'root', '', 'eponto', 'usuarios');
$atualizar = new Updates($con);

$id = $_POST['id'];
$usuario = $_POST['usuario'];
$email = $_POST['email'];
$vinculo = $_POST['vinculo'];
$privilegio = $_POST['privilegio'];
$empresa = $_POST['empresa'];
/*echo 'Id = '.$id.'<br />';
echo 'usuario = '.$usuario.'<br />';
echo 'email = '.$email.'<br />';
echo 'vinculo = '.$vinculo.'<br />';
echo 'privilegio = '.$privilegio.'<br />'; */
try{
    if ( $usuario == '' ){
        $_SESSION['msg'] = 'Preencha o usuário!';
        header("Location:editarUsuario.php?id={$id}");
    }else if ( empty ($email) ){
        $_SESSION['msg'] = 'Preencha o e-mail!';
        header("Location:editarUsuario.php?id={$id}");
    }else if ( empty ($empresa) ){
        $_SESSION['msg'] = 'Preencha a empresa!';
        header("Location:editarUsuario.php?id={$id}");
    }
    $atualizar->setTabela('usuarios');
    //$atualizar->setCampos('');//Não implementei campos
    $usuarioAtualizado = $atualizar->atualizaUsuario($id, $usuario, $email, $vinculo, $privilegio, $empresa);
    if($usuarioAtualizado === true){
        if ($privilegio == 'Comum'){
             $_SESSION['msg'] = 'Usuário editado com sucesso';
            header('Location:usuarios.php');
        }else if ( ($privilegio == 'Administrador') || ($privilegio == 'Super Admin') ){
            header("Location:editarUsuario.php?id={$id}&editado=1");
        }    
        //echo 'Usuario editado com sucesso';
    }else{
        $_SESSION['msg'] = $usuarioAtualizado;
        header("Location:editarUsuario.php?id={$id}");
        //header('Location:usuarios.php');
        //echo 'Erro ao editar';
    }
}catch(Exception $erro){
    echo "Erro:".$erro;
}
?>
<a href="usuarios.php"> Voltar </a>