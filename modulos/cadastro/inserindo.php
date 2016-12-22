<?php
include_once '../../class/Usuario.class.php';
include_once '../../class/Selects.class.php';
include_once '../../class/Inserts.class.php';
session_start();
$conexao = new Conexao();
$con = $conexao->conexao();
$objSelecionar = new Selects($con);
$usuario = $_POST['usuario'];
//$s = $_POST['senha'];
$senha = sha1($_POST['senha']);
$repitaSenha = sha1($_POST['repitasenha']);
$email = $_POST['email'];
$vinculo = $_POST['vinculo'];
$privilegio = $_POST['privilegio'];
$empresa = $_POST['empresa'];
//echo 'Usuario = '.$usuario.'<br />';
//echo 'Senha criptografada= '.$senha.'<br />';
//echo 'Senha = '.$s.'<br />';
try{
    if ( empty($usuario) ){
        $_SESSION['msg'] = 'Preencha o usuário';
        header("Location:cadastro.php");
    }else if ( empty($senha) ){
        $_SESSION['msg'] = 'Preencha a senha';
        header("Location:cadastro.php");
    }else if ($senha != $repitaSenha){
        $_SESSION['msg'] = 'Senhas não conferem';
        header("Location:cadastro.php");
    }else if ( empty ($email) ){
        $_SESSION['msg'] = 'Preencha o e-mail';
        header("Location:cadastro.php");
    }else if ( empty ($empresa) ){
        $_SESSION['msg'] = 'Preencha a empresa';
        header("Location:cadastro.php");
    }
    
    $objSelecionar->setTabela('usuarios');
    $objSelecionar->setCampos('usuario');
    $usuarioExiste = $objSelecionar->usuarioExiste( strtolower($usuario) ) ;
    $emailExiste = $objSelecionar->emailExiste( strtolower($email) );
    if($usuarioExiste){
        $_SESSION['msg'] = 'Usuário já cadastrado anteriormente, insira outro!';
        header("Location:cadastro.php");
    }else if($emailExiste){
        $_SESSION['msg'] = 'E-mail já cadastrado anteriormente, insira outro!';
        header("Location:cadastro.php");
    }else{
        $novo_usuario = new Usuario($usuario,$email,$vinculo,$privilegio);
        $novo_usuario->setSenha($senha);
        $novo_usuario->setEmpresa($empresa);
        //$cadastro_banco = new Inserts('localhost','root','', 'eponto', 'usuarios' );
        $cadastro_banco = new Inserts($con);
        $cadastro_banco->setTabela('usuarios');
        $cadastrarUsuario = $cadastro_banco->cadastroConta($novo_usuario);

        if ($cadastrarUsuario === true){
            $_SESSION['msg'] = 'Usuário cadastrado com sucesso!';
            header("location:../../index.php");
        }else{
            $_SESSION['msg'] = $cadastrarUsuario;
            header("Location:cadastro.php");
        }
        //echo 'Usuario no objeto= '.$novo_usuario->getUsuario().'<br />';
        //echo 'Senha no objeto = '.$novo_usuario->getSenha().'<br />';
    }
}catch(Exception $erro){
        echo "Erro:".$erro;
}

?>
