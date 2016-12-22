<?php
include_once '../../class/Selects.class.php';
include_once '../../class/Usuario.class.php';
//include_once 'class/Horario.class.php';
session_start();
$usuario = $_POST['usuario'];
$senha = sha1($_POST['senha']);

$conexao = new Conexao();
$con = $conexao->conexao();
//$ponto = new Horario();
//$oUsuario = new Usuario($usuario, $senha);
$login = new Selects($con);

$login->setTabela('usuarios');
$login->setCampos('ativo');
$usuarioEstaAtivo = $login->usuarioEstaAtivo($usuario);

if($usuarioEstaAtivo == 'Usuario inexistente'){
	$_SESSION['msg'] = 'Usuário inexistente!';
	header("Location:../../index.php");
}else if( $usuarioEstaAtivo == 'ativo' ){ //Caso o usuário esteja ativo

    //Não modifiquei o valor da tabela, pois continua sendo a mesma
    $login->setCampos('*'); //Modifiquei o valor de campos, que esteja como ativo
    $logado = $login->buscaUser($usuario, $senha);
    //echo "Erro {$usuario}";
    
    if ($logado){	
        //echo "$usuario";
        //echo 'Id = '.$logado->getId().'<br />';
        //echo 'Usuario = '.$logado->getUsuario().'<br />';
        //echo 'Senha = '.$logado->getSenha().'<br />';
        //$_SESSION['logado'] = serialize($logado); //Converte o objeto para string
        $_SESSION['logado'] = $logado; //Comentei a linha acima, pois estava dando erro
        //print_r($_SESSION['cadastro']).'<br />';
        //print_r($_SESSION['cadastro']);
        //echo $_SESSION['cadastro'];

        if ( ($logado->getPrivilegio() == "Administrador") || ($logado->getPrivilegio() == "Super Admin") ){
            header("Location:../administrador/administrador.php");
        }else{
            header("Location:logado.php");
        }
    }else{
        $_SESSION['msg'] = 'Usuário ou senha incorreto(s)!';
        header("Location:../../index.php");
    }
}else{ //Caso o usuário esteja inativo
    $_SESSION['msg'] = 'Seu usuário está desativado!';
    header("Location:../../index.php");
}
?>
