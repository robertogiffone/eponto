<?php
include_once '../../class/Usuario.class.php';
include_once '../../class/Selects.class.php';
include_once '../../class/Geral.class.php';
session_start();
$conexao = new Conexao();
$con = $conexao->conexao();
$selecionar = new Selects($con);

$objGeral = new Geral();
if ( isset($_SESSION['logado']) ){
    $usuario = $_SESSION['logado'];
    //$usuario = unserialize($_SESSION['logado']); //Sessão como objeto,caso fosse string converteria para objeto
}else{
    header('Location:../../index.php');
}

$vinculo = $usuario->getVinculo();
if ( $_GET['consultar']==1 ){
    //if ( (empty($_POST['dataInicial'])) || ( empty($_POST['dataFinal']) ) ){
	if ( empty($_POST['periodo'] ) ){
        $_SESSION['msg'] = 'Favor preencha o período';
    }else{
        //$ordenaDados = 10; //Vai conter os valores da coluna responsável por ordenar os dados em ordem decrescente
		$periodo = $_POST['periodo'];
        $dataInicio = $objGeral->formataDataBanco( substr($periodo, 0, 10) ); 
        $dataFinal = $objGeral->formataDataBanco( substr($periodo, 13) );
        $selecionar->setTabela('pontos');
        $selecionar->setCampos('*');
        $pontos = $selecionar->consultaPontosPorPeriodo($usuario->getId(), $dataInicio, $dataFinal);
        $qtdPontos = count($pontos); //Responsável por contar quantidade de pontos retornados do banco
        $segundosTrabalhados = 0; //Responsável por armazenar quantidade de segundos trabalhados no periodo de pontos retornado
    }
}
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Consultar pontos</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	    <!-- Bootstrap 3.3.2 -->
	    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- DATA TABLES -->
		<link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	    <!-- Font Awesome Icons -->
	    <link href="../../css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	    <!-- Ionicons -->
	    <link href="../../css/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
		<!-- daterange picker -->
		<link href="../../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	    <!-- Theme style -->
	    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	    <!-- AdminLTE Skins. Choose a skin from the css/skins
	         folder instead of downloading all of them to reduce the load. -->
	    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	    	<script src="../../js/html5shiv-3.7.0/html5shiv.js"></script>
	    	<script src="../../js/respond.js-1.3.0/respond.min.js"></script>
	    <![endif]--> 
		
    <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  	<body class="skin-blue layout-top-nav">
		
		<div class="wrapper">
      
			<header class="main-header">               
				<nav class="navbar navbar-static-top">
					<div class="container-fluid">
						<div class="navbar-header">
							<img src="../../img/logo.png" alt="logo" class="img" />
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							  <i class="fa fa-bars"></i>
							</button>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="navbar-collapse">
							
							<ul class="nav navbar-nav navbar-right">
								<li> <a href="logado.php"> Início </a> </li>
								<li> <a href="../administrador/editarUsuario.php?id=<?php echo $usuario->getId(); ?>"> Editar conta </a> </li>
								<li> <a href="../../alterarSenha.php?id=<?php echo $usuario->getId(); ?>"> Alterar senha </a> </li>
								<li> <a href="../../logout.php"> Sair </a> </li>
							</ul>
							
						</div><!-- /.navbar-collapse -->
						
					</div><!-- /.container-fluid -->
					<!-- Fica junto com os links quando a tela fica menor, por isso tirei
					<h2> <?php echo 'Bem-vindo '. $usuario->getUsuario()  ?> </h2>
					-->
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
						
							<div class="col-md-6 col-md-offset-3">
								<div class="box box-primary">
									<div class="box-header">
									  <h3 class="box-title">Consultar pontos</h3>
									</div>
									<form name="consultarPontos" id="consultarPontos" onsubmit="return validaConsultarPontos();" action="consultaPontos.php?consultar=1" method="post">
									
										<div class="box-body">
											
											
											<!-- Date range -->
											<div class="form-group">
											
												<label>Período:</label>
												<div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" name="periodo" id="periodo"/>
												</div><!-- /.input group -->
											</div><!-- /.form group -->
											
										</div><!-- /.box body -->
									
										<div class="box-footer">
											<button type="submit" class="btn btn-primary"> Consultar </button>
										</div>
									</form>
								</div> 	<!-- /.box -->					
							</div> <!-- /.col -->

						</div>
						
						
						<?php
							if( isset($pontos) && $_GET['consultar'] == 1 ){
								include_once 'listaConsultaPontos.php';
							}else if ( $_GET['consultar'] == 1  && (!empty($_POST['periodo'])) ){
                  
						?>
								<div class="box-body">
									<div class="callout callout-danger">
										<h4><i class="icon fa fa-ban"></i> Nenhum ponto registrado no período informado</h4>
									</div>
								</div>
						<?php    
							}
						?>
						
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
	    <script src="../../plugins/jQuery/jQuery-2.1.3.min.js"></script>
	    <!-- Bootstrap 3.3.2 JS -->
	    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	    <!-- SlimScroll -->
	    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	    <!-- FastClick -->
	    <script src='../../plugins/fastclick/fastclick.min.js'></script>
	    <!-- AdminLTE App -->
	    <script src="../../dist/js/app.min.js" type="text/javascript"></script>
		<!--<script type="text/javascript" src="../../js/jquery-1.10.1.min.js"></script>-->
        <script type="text/javascript" src="../../js/jquery-ui-1.10.4.custom.min.js"></script>
        <!-- DATA TABES SCRIPT -->
		<script src="../../plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
		<script src="../../plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
		<!-- date-range-picker -->
		<script src="../../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="../../js/consultarPontos.js"></script>
		<script type="text/javascript" src="../../js/analytics.js"></script>
	
    </body>
</html>
