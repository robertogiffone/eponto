<?php
include_once 'class/Selects.class.php';
include_once 'class/Updates.class.php';
session_start();
$conexao = new Conexao();
$con = $conexao->conexao();
$selecionar = new Selects($con);
$atualizar = new Updates($con);
$id = $_POST['id'];
if ( (empty($_POST['senhaatual'])) || (empty($_POST['novasenha'])) || (empty($_POST['repitanovasenha'])) ){
    $_SESSION['msg'] = 'Preencha todos os campos';
    header("Location: alterarSenha.php?id={$id}");
}else{
    $senhaAtual = sha1($_POST['senhaatual']);
    $novaSenha = sha1($_POST['novasenha']);
    $repitaNovaSenha = sha1($_POST['repitanovasenha']);
    $selecionar->setTabela('usuarios');
    $selecionar->setCampos('senha');
    $senhaDefinida = $selecionar->comparaSenha($id, $senhaAtual); //Compara se a senha definida no banco é igual a digitada
    
    if ($senhaDefinida){
        if ($novaSenha == $repitaNovaSenha){
            $atualizar->setTabela('usuarios');
            $atualizaSenha = $atualizar->atualizaSenha($id, $novaSenha);
            if ($atualizaSenha){
                $_SESSION['msg'] = 'Senha atualizada com sucesso!';
                header("Location: alterarSenha.php?id={$id}");
                //echo 'Senha atualizada com sucesso<br />';
            }else{
                $_SESSION['msg'] = 'Erro ao atualizar senha!';
                header("Location: alterarSenha.php?id={$id}");
                //echo 'Erro ao atualizar senha<br />';
            }
        }else{
            $_SESSION['msg'] = 'Nova senha e repita nova senha não conferem!';
            header("Location: alterarSenha.php?id={$id}");
            //echo 'Nova senha não confere<br />';
        }
    }else{
        $_SESSION['msg'] = 'Senha atual não confere!';
        header("Location: alterarSenha.php?id={$id}");
        //echo 'Senha definida não confere<br />';
    }
}


?>
