<?php
include_once 'class/Usuario.class.php';
session_start();
if ( isset($_SESSION['logado']) ){
    $usuario = $_SESSION['logado'];
    //$usuario = unserialize($_SESSION['logado']); //Sessão como objeto,converte string para objeto
}else{
    header('Location:index.php');
}

//$msg = '';
//if (isset ($_SESSION['msg']) ){
//    $msg =  $_SESSION['msg'];
//}
//unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Alterar senha</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="css/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="css/estilo.css" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    	<script src="js/html5shiv-3.7.0/html5shiv.js"></script>
    	<script src="js/respond.js-1.3.0/respond.min.js"></script>
    <![endif]-->
    
</head>

<body class="skin-blue layout-top-nav">
	<div class="wrapper">
      
		<header class="main-header">               
			<nav class="navbar navbar-static-top">
				<div class="container-fluid">
					<div class="navbar-header">
						<img src="img/logo.png" alt="logo" class="img" />
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						  <i class="fa fa-bars"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbar-collapse">
							
						<ul class="nav navbar-nav navbar-right">
    						
    						<?php
		                    if ( ($usuario->getPrivilegio() == 'Administrador') || ($usuario->getPrivilegio() == 'Super Admin') ){
		                    ?>
		                        <li> <a href="modulos/administrador/administrador.php"> Início </a> </li>
		                        <li> <a href="modulos/administrador/consultarPontos.php?consultar=0"> Consultar pontos </a> </li>
		                    <?php
		                    }else if( $usuario->getPrivilegio() == 'Comum' ){
		                    ?>
		                        <li> <a href="modulos/logado/logado.php"> Início </a> </li>
		                        <li> <a href="modulos/logado/consultaPontos.php?consultar=0"> Consultar pontos </a> </li>
		                    <?php
		                    }
		                    ?>
		                    <?php
				            if ($usuario->getPrivilegio() == 'Administrador'){    
				            ?>
				            	<li> <a href="modulos/administrador/usuarios.php"> Administrar usuários </a> </li>
				            <?php
				            }
				            ?>
			                <li> <a href="modulos/administrador/editarUsuario.php?id=<?php echo $usuario->getId(); ?>"> Editar conta </a> </li>
		                    <li> <a href="logout.php"> Sair </a> </li>
		                    	
    					</ul>
    				</div><!-- /.navbar-collapse -->
					
				</div><!-- /.container-fluid -->
   			</nav> 
    	</header>
    	
    	<!-- Full Width Column -->
		<div class="content-wrapper">
			<div class="container-fluid">
				    
				<!-- Main content -->
				<section class="content">
          
					<p id="msg"> 
						<?php
							include_once 'mensagem.php';
						?>
					</p>
					
					<div class="row">
	            <!-- left column -->
	            <div class="col-md-6 col-md-offset-3">
		              <!-- general form elements -->
		              <div class="box box-primary">
		                <div class="box-header">
		                  <h3 class="box-title">Alterar senha</h3>
		                </div><!-- /.box-header -->
		                <!-- form start -->
		                <form name="alteraSenha" action="alteraSenha.php" method="post" onsubmit="return validaAlteraSenha();" role="form">
		                  <div class="box-body">
		                  	<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
		                    <div class="row form-group">
		                    	<div class="col-xs-4">
		                        	<label for="senhaatual">Senha atual</label>
		                       	</div>
		                       	<div class="col-xs-8">
		                      		<input type="password" name="senhaatual" id="senhaatual" class="form-control" placeholder="Digite a senha atual">
		                    	</div>
		                    </div>
		                    
		                    <div class="row form-group">
		                    	<div class="col-xs-4">
		                      		<label for="novasenha">Nova senha</label>
		                    	</div>  
		                      	<div class="col-xs-8">
		                      		<input type="password" name="novasenha" id="novasenha" class="form-control" placeholder="Digite a nova senha acima">
		                    	</div>
		                    </div>
		                     
		                    <div class="row form-group">
		                    	<div class="col-xs-4">
		                      		<label for="repitanovasenha">Repita a nova senha</label>
		                    	</div>  
		                      	<div class="col-xs-8">
		                      		<input type="password" name="repitanovasenha" id="repitanovasenha" class="form-control" placeholder="Digite novamente a nova senha">
		                    	</div>
		                    </div>
		                    
		                    
		                  </div><!-- /.box-body -->
		
		                  <div class="box-footer">
		                    <button type="submit" class="btn btn-primary"> Alterar </button>
		                    <button type="reset" class="btn btn-primary"> Limpar </button>
		                  </div>
		                </form>
		              </div><!-- /.box -->
		        	</div><!-- /.col -->
	       		</div><!-- /.row -->
        
					
					
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
	<script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>

	<script type="text/javascript" src="js/alteraSenha.js"> </script>
	
	<script type="text/javascript" src="js/analytics.js"></script>

</body>
</html>
