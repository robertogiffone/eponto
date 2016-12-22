<?php
//include_once 'class/Ponto.class.php';
try{
    include_once '../../class/Geral.class.php';
    include_once '../../class/Selects.class.php';
    include_once '../../class/Updates.class.php';
    session_start();
    $objGeral = new Geral();
    $conexao = new Conexao();
    $con = $conexao->conexao();
    $selecionar = new Selects($con);
    $atualizar = new Updates($con);
    //echo $_SESSION['cadastro'].'<br />'; //Sessão como string
    
    if ( isset($_SESSION['logado']) ){
        $sessaoUsuario = $_SESSION['logado'];
        //$sessaoUsuario = unserialize($_SESSION['logado']); //Sessão como objeto, caso fosse string converteria para objeto
    }else{
        header('Location:../../index.php');
    }
    //print_r($usuario).'<br />';
    //echo $usuario->getUsuario();
    $usuario_id = $sessaoUsuario->getId();
    //$diaAtual = date('Y/m/d');
    //$timestamp = time()-10800;
    //$timestamp = $objGeral->ntp_time();
    $timestamp = time();
    $diaAtual = date('Y-m-d', $timestamp);
    $selecionar->setTabela('pontos');
    $selecionar->setCampos('*');
    $temEntrada = $selecionar->buscaEntrada($usuario_id, $diaAtual);

    if ($temEntrada){
        $temEntradaAlmoco = $selecionar->buscaEntradaAlmoco($usuario_id, $diaAtual);
        if ($temEntradaAlmoco){
            $_SESSION['msg'] = 'Entrada almoço já foi inserida hoje!';
            header("Location: logado.php");
            //echo 'Entrada almoço já foi inserida hoje!';
        }else{
            $atualizar->setTabela('pontos');
            $entradaAlmoco = $atualizar->entradaAlmoco($usuario_id, $diaAtual, $timestamp);
            if ($entradaAlmoco){
                $_SESSION['msg'] = 'Entrada almoço foi inserida com sucesso!';
                header("Location: logado.php");
                //echo 'Entrada almoco foi inserida com sucesso!';
            }else{
                $_SESSION['msg'] = 'Erro na tentativa de inserir a entrada almoço!';
                header("Location: logado.php");
                //echo 'Erro na tentativa de inserir a entrada almoço!';
            }
        }
    }else{
        $_SESSION['msg'] = 'Por favor primeiro insira a entrada!';
        header("Location: logado.php");
        //echo 'Por favor primeiro insira a entrada!';
    }           
}catch(Exception $erro){
	$_SESSION['msg'] = 'Erro na conexão com o banco de dados!';
	//echo 'Erro na conexão com o banco de dados!';
    //$_SESSION['msg'] = 'Erro:'.$erro;
    header("Location: logado.php");
    //echo "Erro:".$erro.'<br />';
}
?>
<!-- <a href="logado.php">Voltar</a>  -->
