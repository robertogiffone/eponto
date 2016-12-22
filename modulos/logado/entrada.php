<?php
include_once '../../class/Geral.class.php';
include_once '../../class/Ponto.class.php';
include_once '../../class/Selects.class.php';
include_once '../../class/Inserts.class.php';
include_once '../../class/Usuario.class.php';
try{
    session_start();
    $objGeral = new Geral();
    $ponto = new Ponto();
    $conexao = new Conexao();
    $con = $conexao->conexao();
    $selecionar = new Selects($con);
    $inserirHorario = new Inserts($con);
   
    if ( isset($_SESSION['logado']) ){
        $sessaoUsuario = $_SESSION['logado'];
        //$sessaoUsuario = unserialize($_SESSION['logado']); //Sessão como objeto, caso fosse string converteria para objeto
    }else{
        header('Location:../../index.php');
    }
    //$diaAtual = date('Y/m/d');
    //$timestamp = time()-10800-39600;
    //14400 4 horas //18000 5 horas //21600 6 horas //25200 7 horas //28800 8 horas //32400 9 horas 
    //39600 11 horas //43200 12 horas //46800 13 horas //50400 14 horas //54000 15 horas //57600 16 horas
    
    //$timestamp = $objGeral->ntp_time();
    $timestamp = time();
    $diaAtual = date('Y-m-d', $timestamp);
    $usuario_id = $sessaoUsuario->getId();
    
    $selecionar->setTabela('pontos');
    $selecionar->setCampos('*');
    $temEntrada = $selecionar->buscaEntrada($usuario_id, $diaAtual);
    
    if ($temEntrada){
        //echo 'Entrada já foi inserida hoje!';
        $_SESSION['msg'] = 'Entrada já foi inserida hoje!';
        header("Location: logado.php");
    }else{
        $ponto->setUsuarioId($sessaoUsuario->getId());
        $ponto->setUsuario($sessaoUsuario->getUsuario());
        $ponto->setDia($diaAtual);
        $ponto->setEntrada($timestamp);
        $inserirHorario->setTabela('pontos');
        $inserirHorario->setCampos('usuario_id,usuario,dia,entrada');
        $insereEntrada = $inserirHorario->entrada($ponto);
        if($insereEntrada){
            //echo 'Entrada inserida com sucesso!';
            $_SESSION['msg'] = 'Entrada inserida com sucesso!';
            header("Location: logado.php");
        }else{
            $_SESSION['msg'] = 'Erro ao inserir entrada!';
            //echo 'Erro ao inserir entrada!';
            header("Location: logado.php");
        }
    }
    
}catch(Exception $erro){
	//echo 'Erro na conexão com o banco de dados!';
	$_SESSION['msg'] = 'Erro na conexão com o banco de dados!';
    //$_SESSION['msg'] = 'Erro = '.$erro;
    header("Location: logado.php");
    //echo 'Erro = '.$erro;
}
?>
<!-- <a href="logado.php"> Voltar </a>  -->
