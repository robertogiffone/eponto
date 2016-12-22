<?php
include_once 'class/Usuario.class.php'; //Necessário para a sessão, caso o usuário esteja logado
session_start();
if ( isset($_SESSION['logado']) ){
	if( $_SESSION['logado']->getPrivilegio() == 'Comum' ){
		header('Location:modulos/logado/logado.php');
	}else{ //Para administrador e super administrador
		header('Location:modulos/administrador/administrador.php');
	}
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Página inicial</title>
    <meta name="robots" content="all" />
	<meta name="keywords" content="Ponto eletrônico,ponto eletrônico roberto giffone,eponto,eponto roberto giffone,eponto roberto,eponto giffone,roberto giffone" />
	<meta name="description" content="Com função comum é possível bater ponto,editar e visualizar pontos de seu usuário" />
	<meta name="Author" content="Ponto eletrônico" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="css/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="css/index.css" rel="stylesheet" type="text/css" />
    <link href="css/estilo.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    	<script src="js/html5shiv-3.7.0/html5shiv.js"></script>
    	<script src="js/respond.js-1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">
      
      <header class="main-header">               
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
          
	          <div class="navbar-header">
	          	<img src="img/logo.png" alt="logo" class="img" />
	          </div>
          
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Ponto Eletrônico
              <small>Faça login ou cadastre-se abaixo</small>
            </h1>
            
          </section>

          <!-- Main content -->
          <section class="content">
          
          	<p id="msg"> 
	            <?php
	            include_once 'mensagem.php';
	            ?>
            </p>
          	
          	<!-- Fazer um css próprio para consertar esse erro -->
		    <div class="login-box login-box-sem-margem-sup-inf">
		      <div class="login-logo">
		        <h1>Login</h1>
		      </div><!-- /.login-logo -->
		      <div class="login-box-body">
		        <p class="login-box-msg"> Favor fazer login para iniciar sua sessão </p>
		        <form name="login" action="modulos/logado/logando.php" method="post" onsubmit="return validaLogin();">
		          <div class="form-group has-feedback">
		            <input type="text" name="usuario" class="form-control" placeholder="Usuário" onkeypress="return somenteLetras(event.keyCode, event.which);" />
		            <span class="glyphicon glyphicon glyphicon-user form-control-feedback"></span>
		          </div>
		          <div class="form-group has-feedback">
		            <input type="password" name="senha" class="form-control" placeholder="Senha"/>
		            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
		          </div>
		          <div class="row">
		            <div class="col-xs-8">    
		              <!-- <div class="checkbox icheck">
		                <label>
		                  <input type="checkbox"> Remember Me
		                </label>
		              </div>  -->                        
		            </div><!-- /.col -->
		            <div class="col-xs-4">
		              <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
		            </div><!-- /.col -->
		          </div>
		        </form>
		
		        <!-- <a href="#">Esqueceu sua senha</a><br>  -->
		        <a href="modulos/cadastro/cadastro.php" class="text-center">Cadastre-se</a>
		
		      </div><!-- /.login-box-body -->
		    </div><!-- /.login-box -->

          
          	<h3 class="aviso"> Aviso: </h3>
            <p>
            	Caso tenha interesse em adquirir um sistema de ponto eletrônico ou testar as funções de administrador. 
            	Entre em contato através do e-mail ou telefone no rodapé.
            </p>
          
             
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="container-fluid">
          <div class="rodape-center">
          	<p> <strong>Copyright &copy; 2014</strong> | Roberto Giffone | roberto.giffone@gmail.com | (85)98872-2822 </p>
          </div>
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <script type="text/javascript" src="js/login.js"></script>
    <script type="text/javascript" src="js/cadastro.js"></script>
    
    <script type="text/javascript" src="js/analytics.js"></script>
    
  </body>
</html>
