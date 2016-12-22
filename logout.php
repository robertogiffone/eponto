<?php
session_start(); //Inicia a sessão, é necessário para trabalhar com functions de session
session_destroy(); //Destruindo as sessões
header('Location:index.php'); //Redireciona para index.php
?>
