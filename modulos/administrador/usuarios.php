<?php
include_once '../../class/Usuario.class.php';
include_once '../../class/Selects.class.php';
include_once '../../class/Geral.class.php';
session_start();

if ( isset($_SESSION['logado']) ){
    $usuario = $_SESSION['logado'];
    //$usuario = unserialize($_SESSION['logado']); //Sessão como objeto,recebe uma string e converte para objeto
}else{
    header('Location:../../index.php');
}

if( $usuario->getPrivilegio() == 'Comum' ){ //Para tratar que usuário comum não tenha acesso a página de administrador
    header('Location:../logado/logado.php');
}
$conexao = new Conexao();
$con = $conexao->conexao();
//$selecionar = new Selects('localhost', 'root', '', 'eponto', 'usuarios');
$selecionar = new Selects($con);
$selecionar->setTabela('usuarios');
$selecionar->setCampos('id,usuario,email,vinculo,privilegio,empresa,ativo');
$usuarios = $selecionar->retornaUsuarios( $usuario->getEmpresa(), $usuario->getPrivilegio() );
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administrador usu&aacute;rios</title>
        <!-- Bootstrap 3.3.2 -->
	    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<!-- DATA TABLES -->
		<link href="../../plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	    <!-- Font Awesome Icons -->
	    <link href="../../css/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	    <!-- Ionicons -->
	    <link href="../../css/ionicons-2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	    <!-- Theme style -->
	    <link href="../../dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
	    <!-- AdminLTE Skins. Choose a skin from the css/skins
	         folder instead of downloading all of them to reduce the load. -->
	    <link href="../../dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
		<link href="../../css/logado.css" rel="stylesheet" type="text/css" />
        
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
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					  </div>
			
					  <!-- Collect the nav links, forms, and other content for toggling -->
					  <div class="collapse navbar-collapse" id="navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
						 
						 <li> <a href="administrador.php"> Início </a> </li>
						 <li> <a href="consultarPontos.php?consultar=0"> Consultar pontos </a> </li>
                         <li> <a href="editarUsuario.php?id=<?php echo $usuario->getId(); ?>"> Editar conta </a> </li>
                         <li> <a href="../../alterarSenha.php?id=<?php echo $usuario->getId(); ?>"> Alterar senha </a> </li>   
                         <li> <a href="../../logout.php"> Sair </a> </li>   

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
			                    include_once '../../mensagem.php';
			                    if ( isset($_GET['inativo'] ) ){
			                        if( $_GET['inativo'] == 1)
			                            echo 'Usuário inativado com sucesso!';
			                        else if ( $_GET['inativo'] == 0)
			                            echo 'Erro ao tentar desativar usuário!';
			                    }else if( isset($_GET['ativo'] ) ){
			                        if( $_GET['ativo'] == 1)
			                            echo 'Usuário ativado com sucesso!';
			                        else if ( $_GET['ativo'] == 0)
			                            echo 'Erro ao tentar ativar usuário!';
			                    }
			                ?>
			               </p>
			               
			               <div class="row">
						
								<div class="col-md-12">
								
									<div class="box">
										<div class="box-header">
									  		<h3 class="box-title">Usuários</h3>
										</div><!-- /.box-header -->
										<div class="box-body">
										<?php
						                if( isset($usuarios) ){
						                ?>
										
											<table id="usuarios" class="table table-bordered table-striped">
				                                <thead>
				                                    <tr>
				                                        <th>Usu&aacute;rio</th>
				                                        <th>E-mail</th>
				                                        <th>V&iacute;nculo</th>
				                                        <th>Privil&eacute;gio</th>
				                                        <th> Empresa </th>
				                                        <th> Editar </th>
				                                         <th> Resetar senha </th>
				                                        <th> Ativar/Desativar </th>
				                                        <!--<th> Alterar senha </th>-->
				                                        <th> Situa&ccedil;&atilde;o </th>
				                                    </tr>
				                                </thead>
                                				<tbody>
				                                    <?php
				                                    foreach($usuarios as $usuario){
				                                    ?>
				                                        <tr>
				                                            <td> <?php echo $usuario['usuario'] ?> </td>
				                                            <td> <?php echo $usuario['email'] ?> </td>
				                                            <td> <?php echo $usuario['vinculo'] ?> </td>
				                                            <td> <?php echo $usuario['privilegio'] ?> </td>
				                                            <td> <?php echo $usuario['empresa']  ?> </td>
				                                            <td> <a href="editarUsuario.php?id=<?php echo $usuario['id'] ?>" > Editar </a> </td>
				                                            <!--<td> <a href="deletarUsuario.php?id=<?php echo $usuario['id'] ?>" > Deletar </a> </td>-->
				                                             <td> <a href="../../resetarSenha.php?id=<?php echo $usuario['id'] ?>" > Resetar senha </a> </td>
				                                            <?php
				                                            if ($usuario['ativo'] == 'N' ){
				                                            ?>
				                                                <td> <a href="ativarUsuario.php?id=<?php echo $usuario['id'] ?>" > Ativar </a> </td>
				                                            <?php
				                                            }else if ($usuario['ativo'] == 'S' ){
				                                            ?>
				                                                <td> <a href="desativarUsuario.php?id=<?php echo $usuario['id'] ?>" > Desativar </a> </td>
				                                            <?php
				                                            }
				                                            ?>
				                                            <!--<td> <a href="../../alterarSenha.php?id=<?php echo $usuario['id'] ?>" > Alterar senha </a> </td>-->
				                                            <?php
				                                            if ($usuario['ativo'] == 'S' ){
				                                            ?>
				                                                <td> Ativo </td>
				                                            <?php
				                                            }else if ($usuario['ativo'] == 'N' ){
				                                            ?>
				                                                <td> Inativo </td>
				                                            <?php
				                                            }
				                                            ?>
				                                        </tr>
				                                    <?php
				                                    }
				                                    ?>
                                				</tbody>
                    						</table>
							                <?php
							                }else{
							                ?>
							                <div class="alert alert-danger alert-dismissable">
												<h4><i class="icon fa fa-ban"></i> Nenhum usuário cadastrado</h4>
								            </div>
							               <?php
							               }
							               ?>	
	    								
	    								</div><!-- /.box-body -->
									</div> <!-- /.box -->
								
								</div> <!-- /.col -->
							
							</div> <!-- /.row -->
					
    		
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
       
       	<script type="text/javascript" src="../../js/usuarios.js"></script>
        <script type="text/javascript" src="../../js/analytics.js"></script>
   
    </body>
</html>
