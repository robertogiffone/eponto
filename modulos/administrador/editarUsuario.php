<?php
include_once '../../class/Selects.class.php';
session_start();
$conexao = new Conexao();
$con = $conexao->conexao();
$selecionar = new Selects($con);
$selecionar->setTabela('usuarios');
$selecionar->setCampos('usuario,email,vinculo,privilegio,empresa');
$usuario = $selecionar->retornaDadosDoUsuarioPorId($_GET['id']);
if ( isset($_SESSION['logado']) ){
	$user = $_SESSION['logado'];
	//$user = unserialize($_SESSION['logado']); //Sessão como objeto.pega uma string e converte para objeto
}else{
	header('Location:../../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Editar usu&aacute;rio</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!-- Bootstrap 3.3.2 -->
	<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<!-- Font Awesome Icons -->
	<link href="../../css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<!-- Ionicons -->
	<link href="../../css/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- Theme style -->
	<link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	<!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
	<link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    	<script src="../../js/html5shiv-3.7.0/html5shiv.js"></script>
    	<script src="../../js/respond.js-1.3.0/respond.min.js"></script>
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
						<button type="button" class="navbar-toggle collapsed"
							data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbar-collapse">

						<ul class="nav navbar-nav navbar-right">
							<?php
							if( ($user->getPrivilegio()=='Administrador') || ($user->getPrivilegio()=='Super Admin') )
							{
								?>
							<li><a href="administrador.php"> Início </a>
							</li>
							<li><a href="consultarPontos.php?consultar=0"> Consultar pontos </a>
							</li>
							<?php 
							}else{
								?>
							<li><a href="../logado/logado.php"> Início </a>
							</li>
							<li><a href="../logado/consultaPontos.php?consultar=0"> Consultar
									pontos </a>
							</li>
							<?php 
							}
							?>
							<?php
							if( ($user->getPrivilegio()=='Administrador') || ($user->getPrivilegio()=='Super Admin') ){
								?>
							<li><a href="usuarios.php"> Administrar usuários </a>
							</li>
							<?php
							}
							?>
							<li><a
								href="../../alterarSenha.php?id=<?php echo $user->getId(); ?>">
									Alterar senha </a>
							</li>
							<li><a href="../../logout.php"> Sair </a>
							</li>
						</ul>

					</div>
					<!-- /.navbar-collapse -->

				</div>
				<!-- /.container-fluid -->
				
			</nav>

		</header>

		<!-- Full Width Column -->
		<div class="content-wrapper">
			<div class="container-fluid">

				<!-- Main content -->
				<section class="content">

					<p id="msg">
						<?php
						//include_once '../../mensagem.php';
	                    if ( isset($_GET['editado'] ) ){
	                        echo 'Usuário editado com sucesso';
	                    }
						?>
					</p>

					<div class="row">
						<!-- left column -->
						<div class="col-md-6 col-md-offset-3">
							<!-- general form elements -->
							<div class="box box-primary">
								<div class="box-header">
									<h3 class="box-title">Editar Cadastro</h3>
								</div>
								<!-- /.box-header -->
								<!-- form start -->
								<form name="editar" action="atualizaUsuario.php" method="post"
									onsubmit="return validaEdicao();" role="form">
									<div class="box-body">
										<input type="hidden" name="id"
											value="<?php echo $_GET['id'] ?>" />
										<div class="row form-group">
											<div class="col-xs-3">
												<label>Usuário</label>
											</div>
											<div class="col-xs-9">
												<input type="text" name="usuario" id="usuario"
													value="<?php echo $usuario['usuario']; ?>"
													class="form-control" placeholder="Digite o usuário" />
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-3">
												<label for="email">Email</label>
											</div>
											<div class="col-xs-9">
												<input type="email" name="email" id="email"
													value="<?php echo $usuario['email']; ?>"
													class="form-control" placeholder="Digite seu e-mail">
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-3">
												<label>Vínculo</label>
											</div>
											<div class="col-xs-9">
												<select name="vinculo" id="vinculo" class="form-control">
													<?php
													if ($usuario['vinculo'] == 'Funcionario'){
														?>
													<option value="Funcionario" selected="selected">
														Funcion&aacute;rio</option>
													<option value="Estagiario">Estagi&aacute;rio</option>
													<?php
													}else if ($usuario['vinculo'] =='Estagiario'){
														?>
													<option value="Funcionario">Funcion&aacute;rio</option>
													<option value="Estagiario" selected="selected">
														Estagi&aacute;rio</option>
													<?php
													}
													?>
												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col-xs-3">
												<label>Privilégio</label>
											</div>
											<div class="col-xs-9">
												<select name="privilegio" id="privilegio"
													class="form-control">
													<?php
													if( $usuario['privilegio'] == 'Super Admin' ){
														?>
													<option value="Super Admin" selected="selected">Super
														Administrador</option>
													<?php
													}

													//else if ($user->getId() == $_GET['id']){ //Caso o usuário administrador esteja editado seus dados
													else if( $usuario['privilegio'] == 'Administrador' ){
														?>
													<option value="Administrador" selected="selected">
														Administrador</option>
													<!--<option value="Comum" > Comum </option>-->
													<?php
													}else if( ($usuario['privilegio'] == 'Comum') && ($user->getPrivilegio()=='Comum') ){ //Caso o usuário comum esteja editando ele mesmo
														?>
													<!--<option value="Administrador" > Administrador </option>-->
													<option value="Comum" selected="selected">Comum</option>
													<?php        
													}else if( ($usuario['privilegio'] == 'Comum') && ( ($user->getPrivilegio()=='Administrador') || ($user->getPrivilegio()=='Super Admin') ) ){ //Caso o administrador ou o super administrador esteja editando o usuário comum
														?>
													<option value="Administrador">Administrador</option>
													<option value="Comum" selected="selected">Comum</option>
													<?php
													}
													?>
												</select>
											</div>
										</div>

										<div class="row form-group">
											<div class="col-xs-3">
												<label>Empresa</label>
											</div>
											<div class="col-xs-9">
												<input type="text" name="empresa" id="empresa"
													value="<?php echo $usuario['empresa']; ?>"
													class="form-control" placeholder="Digite sua empresa" />
											</div>
										</div>

									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button type="submit" class="btn btn-primary">Editar</button>
									</div>
								</form>
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->

				</section>
				<!-- /.content -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="container-fluid">

				<div class="rodape-center">
					<p>
						<strong>Copyright &copy; 2014</strong> | Roberto Giffone |
						roberto.giffone@gmail.com | (85)98872-2822
					</p>
				</div>

			</div>
			<!-- /.container -->
		</footer>

	</div>
	<!-- ./wrapper -->

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

	<script type="text/javascript" src="../../js/cadastro.js"> </script>

	<script type="text/javascript" src="../../js/analytics.js"></script>

</body>
</html>
