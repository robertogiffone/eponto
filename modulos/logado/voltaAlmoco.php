<?php
//include_once '../../class/Ponto.class.php';
try{
    include_once '../../class/Geral.class.php';
    include_once '../../class/Selects.class.php';
    include_once '../../class/Updates.class.php';
    session_start();
    //echo $_SESSION['cadastro'].'<br />'; //Sessão como string
    $objGeral = new Geral();
    $conexao = new Conexao();
    $con = $conexao->conexao();
    $selecionar = new Selects($con);
    $atualizar = new Updates($con);
    //$selecionar = new Selects('localhost', 'root', '', 'eponto', 'pontos');
    //$atualizar = new Updates('localhost', 'root', '', 'eponto', 'pontos');
   
    if ( isset($_SESSION['logado']) ){
        $sessaoUsuario = $_SESSION['logado'];
        //$sessaoUsuario = unserialize($_SESSION['logado']); //Sessão como objeto, caso fosse string converteria para objeto
    }else{
        header('Location:../../index.php');
    }
    //print_r($usuario).'<br />';

    $usuario_id = $sessaoUsuario->getId();
    //$diaAtual = date('Y/m/d');
    //$timestamp = time()-10800;
    //$timestamp = $objGeral->ntp_time();
    $timestamp = time();
    $diaAtual = date('Y-m-d', $timestamp);
    
    $selecionar->setTabela('pontos');
    $selecionar->setCampos('*');
    $temEntrada = $selecionar->buscaEntrada($usuario_id, $diaAtual);
    if($temEntrada){ //Caso tenha entrada inserida para o dia atual
        $temEntradaAlmoco = $selecionar->buscaEntradaAlmoco($usuario_id, $diaAtual);
        if ($temEntradaAlmoco){ //Caso tenha entrada almoco inserida para o dia atual
            $temVoltaAlmoco = $selecionar->buscaVoltaAlmoco($usuario_id, $diaAtual);
            if($temVoltaAlmoco){ //Caso tenha volta almoco inserida para o dia atual
                $_SESSION['msg'] = 'Volta almoço já foi inserida hoje!';
                header("Location: logado.php");
                //echo 'Volta almoço já foi inserida hoje!';
            }else{ //Caso não tenha volta almoco inserida para o dia atual   
                $atualizar->setTabela('pontos');
                $voltaAlmoco = $atualizar->voltaAlmoco($usuario_id, $diaAtual, $timestamp);
                if ($voltaAlmoco){
                    $_SESSION['msg'] = 'Volta almoço foi inserida com sucesso!';
                    header("Location: logado.php");
                    //echo 'Volta almoço foi inserida com sucesso!';
                }else{
                    $_SESSION['msg'] = 'Erro na tentativa de inserir volta almoço!';
                    header("Location: logado.php");
                    //echo 'Erro na tentativa de inserir volta almoço!';
                }
            }
        }else{ //Caso não tenha entrada almoco inserida para o dia atual
           $_SESSION['msg'] = 'Por favor primeiro insira a entrada almoço!';
           header("Location: logado.php"); 
           //echo 'Por favor primeiro insira a entrada almoço!';
        }
    }else{ // Caso não tenha entrada inserida para o dia atual
        $_SESSION['msg'] = 'Por favor primeiro insira a entrada!';
        header("Location: logado.php");
        //echo 'Por favor primeiro insira a entrada!';
    }
    
}catch(Exception $erro){
	$_SESSION['msg'] = 'Erro na conexão com o banco de dados!';
	//echo 'Erro na conexão com o banco de dados!';
    //$_SESSION['msg'] = 'Erro: '.$erro;
    header("Location: logado.php");
    //echo "Erro:".$erro.'<br />';
}
?>
<!-- 
<br />
<a href="logado.php">Voltar</a>
 -->
