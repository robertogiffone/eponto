<?php
include_once 'class/Selects.class.php';
include_once 'class/Updates.class.php';

$objSelecionar = new Selects('localhost', 'root', '', 'eponto', 'usuarios');
$objAtualizar = new Updates('localhost', 'root', '', 'eponto', 'usuarios');

$usuarios = $objSelecionar->retornaTodosOsUsuarios();
print_r($usuarios); 
echo '<br><br><br>';
//$dataLimite = date('Y-m-d', strtotime("+7 days",strtotime( date('Y-m-d H:i:s' ) )));
//echo $dataLimite.'<br>'; 
//die('Die');
foreach( $usuarios as $usuario ){
    $dataLimite = date('Y-m-d', strtotime("+7 days",strtotime( $usuario['dataCadastro'] )));
    $dataAtual = date('Y-m-d');
    if( $dataAtual >= $dataLimite ){
        $desativarUsuario = $objAtualizar->desativarUsuario($usuario['id']);
        if($desativarUsuario) echo 'Ok<br>';
        echo 'Id = '.$usuario['id'].'<br>Data de cadastro = '.$usuario['dataCadastro'].'<br>';
        echo 'Data limite = '.$dataLimite.'<br><br>';
    }
}

die('Pagina finalizada');

//$desativarUsuario = $objAtualizar->desativarUsuario($_GET['id']);
?>
