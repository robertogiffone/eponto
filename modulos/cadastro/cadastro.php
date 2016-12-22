<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> Cadastro </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../../css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="../../css/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="../../css/index.css" rel="stylesheet" type="text/css" />
    <link href="../../css/estilo.css" rel="stylesheet" type="text/css" />

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
	          	<img src="../../img/logo.png" alt="logo" class="img" />
	        </div>
          
          	<ul class="nav navbar-nav navbar-right">
              <li> <a href="../../index.php"> <i class="fa fa-home"></i> <span> Início </span> </a> </li>
            </ul>
          
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
	            include_once '../../mensagem.php';
	            ?>
            </p>
          	
	          <div class="row">
	            <!-- left column -->
	            <div class="col-md-6 col-md-offset-3">
		              <!-- general form elements -->
		              <div class="box box-primary">
		                <div class="box-header">
		                  <h3 class="box-title">Cadastro</h3>
		                </div><!-- /.box-header -->
		                <!-- form start -->
		                <form name="cadastro" action="inserindo.php" method="post" onsubmit="return validaCadastro();" role="form">
		                  <div class="box-body">
		                  	
		                  	<div class="row form-group">
		                      <div class="col-xs-3">
		                      <label>Usuário</label>
		                      </div>
		                      <div class="col-xs-9">
		                      <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Digite o usuário"/>
		                    	</div>
		                    </div>
		                    
		                    <div class="row form-group">
		                    	<div class="col-xs-3">
		                        	<label for="senha">Senha</label>
		                       	</div>
		                       	<div class="col-xs-9">
		                      		<input type="password" name="senha" id="senha" class="form-control" placeholder="Digite a senha">
		                    	</div>
		                    </div>
		                     
		                    <div class="row form-group">
		                    	<div class="col-xs-3">
		                      		<label for="repitasenha">Repita a senha</label>
		                    	</div>  
		                      	<div class="col-xs-9">
		                      		<input type="password" name="repitasenha" id="repitasenha" class="form-control" placeholder="Repita a senha acima">
		                    	</div>
		                    </div>
		                    
		                    <div class="row form-group">
		                    	<div class="col-xs-3">
		                      		<label for="email">Email</label>
		                      	</div>
		                      	<div class="col-xs-9">
		                    		<input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail">
		                    	</div>
		                    </div>
		                    <div class="row form-group">
		                    	<div class="col-xs-3">  
		                      		<label>Vínculo</label>
		                      	</div>
		                      	<div class="col-xs-9">
			                      	<select name="vinculo" id="vinculo" class="form-control">
			                      		<option value="Funcionario"> Funcion&aacute;rio </option>
			                        	<option value="Estagiario"> Estagi&aacute;rio </option> 	 
			                      	</select>
		                    	</div>
		                    </div>
		                    <div class="row form-group">
		                    	<div class="col-xs-3">
		                      		<label>Privilégio</label>
		                      	</div>
		                      	<div class="col-xs-9">
				                    <select name="privilegio" id="privilegio" class="form-control">
				                    	<option value="Comum" selected="selected"> Comum </option>
				                    </select>
		                      	</div>
		                    </div>
		                    
		                    <div class="row form-group">
		                    	<div class="col-xs-3">
		                      		<label>Empresa</label>
		                      	</div>
		                      	<div class="col-xs-9">
		                      		<input type="text" name="empresa" id="empresa" class="form-control" placeholder="Digite sua empresa"/>
		                    	</div>
		                    </div>
		                    
		                  </div><!-- /.box-body -->
		
		                  <div class="box-footer">
		                    <button type="submit" class="btn btn-primary"> Cadastrar </button>
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
          	<p> <strong>Copyright &copy; 2014</strong> | Roberto Giffone | roberto.giffone@gmail.com | (85)8872-2822 </p>
          </div>
        </div><!-- /.container -->
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../js/cadastro.js"></script>
    <script type="text/javascript" src="../../js/analytics.js"></script>
    
  </body>
</html>