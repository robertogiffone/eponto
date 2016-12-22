<?php
include_once 'Conexao.class.php';
include_once 'ConstructCon.php';
include_once 'Usuario.class.php';
//class Selects extends Conexao implements ConstructCon{
class Selects implements ConstructCon{
    private $tabela, $campos;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    //Tenho que repensar a conexao, pois pode dá problemas no futuro iniciando apenas no construtor da classe pai
    //public function __construct($tabela) {
    //    $this->tabela = $tabela;
    //}
    
    public function __construct(PDO $conexao) {
        $this->conexao = $conexao;
    }
    
    public function setTabela($tabela){
        $this->tabela = $tabela;
    }
    
    public function getTabela(){
        return $this->tabela;
    }
    
    public function setCampos($campos){
        $this->campos = $campos;
    }
    
    public function getCampos(){
        return $this->campos;
    }
    
    public function usuarioExiste($usuario){
        try{
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario = LOWER(?)";
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $usuario);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            if($linha){
                return true;
            }else{
                return false;
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }

    public function emailExiste($email){
        try{
            $query = "SELECT $this->campos FROM $this->tabela WHERE email = LOWER(?)";
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $email);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            if($linha){
                return true;
            }else{
                return false;
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function usuarioEstaAtivo($usuario){
        try{
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario = ?";
            $result = $this->conexao->prepare($query);
            $result->bindParam(1, $usuario);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            if( $linha['ativo'] == 'S' ){
                return 'ativo';
            }else if( $linha['ativo'] == 'N' ){
                return 'inativo';
            }else{
            	return 'Usuario inexistente';
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaUser($usuario,$senha){
        try{
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario=?";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuario);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            $senhaDefinida = $linha['senha'];
                
            if($senhaDefinida == $senha){
                $objUsuario = new Usuario($linha['usuario'],$linha['email'],$linha['vinculo'],$linha['privilegio']);
                $objUsuario->setId($linha['id']);
                $objUsuario->setEmpresa($linha['empresa']);
                
                return $objUsuario;

            }    
            return false;
                    
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    //Comecei dia 28/06/2013
    public function buscaEntrada($usuarioId,$diaAtual){
        try{      
            //$query = "SELECT * FROM $this->tabela WHERE usuario_id=$usuarioId AND dia='".$diaAtual."' AND (entrada!=0 || entrada!=NULL) ";
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario_id = ? AND dia = ? AND entrada != 0 ";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuarioId, PDO::PARAM_INT);
            $result->bindParam(2, $diaAtual, PDO::PARAM_STR, 10);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            if ($linha){
                return true;
            }else{
                return false;
            }
        
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }

    public function buscaEntradaAlmoco($usuarioId,$diaAtual){
        try{
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario_id = ? AND dia = ? AND entrada_almoco != 0";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuarioId);
            $result->bindParam(2, $diaAtual);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            if($linha){ //Caso o registro tenha retornado
                return true;
            }else{ //Caso o registro não tenha retornado
                return false;
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }

    public function buscaVoltaAlmoco($usuarioId,$diaAtual){
        try{
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario_id = ? AND dia = ? AND volta_almoco != 0";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuarioId);
            $result->bindParam(2, $diaAtual);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            if($linha){
                return true;
            }else{
                return false;
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function buscaSaida($usuarioId,$diaAtual){
        try{
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario_id = ? AND dia = ? AND saida != 0 ";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuarioId);
            $result->bindParam(2, $diaAtual);
            $result->execute();
            $linha = $result->fetch(PDO::FETCH_ASSOC);
            if($linha){
                return true;
            }else{
                return false;
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaPontosDoUsuario($usuarioId, $dataAtual){
        try{
            $dataLimite = date('Y-m-d', strtotime("-30 days",strtotime("$dataAtual") ) );
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario_id = ? AND dia BETWEEN ? AND ?";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuarioId);
            $result->bindParam(2, $dataLimite);
            $result->bindParam(3, $dataAtual);
            $result->execute();
            $pontos = null;
            if($result){
				$i = 0;
				while($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$pontos[$i]['dia'] = $linha['dia'];
					$pontos[$i]['entrada'] = $linha['entrada'];
					$pontos[$i]['entrada_almoco'] = $linha['entrada_almoco'];
					$pontos[$i]['volta_almoco'] = $linha['volta_almoco'];
					$pontos[$i]['saida'] = $linha['saida'];
					$i++;
				}
			}
			return $pontos;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function buscaTodosOsPontos($empresa, $dataAtual, $privilegio){
        try{
            $dataLimite = date('Y-m-d', strtotime("-30 days",strtotime("$dataAtual") ) );
            //A query satisfaz o super administrador
            $query = "SELECT $this->campos FROM $this->tabela WHERE ativo='S' AND dia BETWEEN ? AND ?";
            if( $privilegio == 'Administrador' ){ //Se for administrador, só vai administrar usuários da sua empresa
                $query .= " AND empresa = ?";
            }
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $dataLimite);
            $result->bindParam(2, $dataAtual);
            if( $privilegio == 'Administrador' ){ //Se for administrador, só vai administrar usuários da sua empresa
                $result->bindParam(3, $empresa);
            }
            $result->execute();
            $pontos = null;
            if($result){
                $i = 0;
                while($linha = $result->fetch(PDO::FETCH_ASSOC)){
                        $pontos[$i]['dia'] = $linha['dia'];
                        $pontos[$i]['usuario'] = $linha['usuario'];
                        $pontos[$i]['entrada'] = $linha['entrada'];
                        $pontos[$i]['entrada_almoco'] = $linha['entrada_almoco'];
                        $pontos[$i]['volta_almoco'] = $linha['volta_almoco'];
                        $pontos[$i]['saida'] = $linha['saida'];
                        $pontos[$i]['vinculo'] = $linha['vinculo'];
                        $i++;
                }
            }
            return $pontos;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }

    //Exclusivo para o perfil administrativo
    public function retornaUsuarios($empresa, $privilegio){
        try{
            if ($privilegio == 'Administrador'){
                $query = "SELECT $this->campos FROM $this->tabela WHERE privilegio != ? AND empresa = ?";
            }else if ($privilegio == 'Super Admin'){
                $query = "SELECT $this->campos FROM $this->tabela WHERE privilegio != ?";
            }
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $privilegio);
            if( $privilegio == 'Administrador' ){ //Se for administrador, só vai administrar usuários da sua empresa
                $result->bindParam(2, $empresa);
            }
            $result->execute();
            
            $usuarios = null;
            if($result){
				$i = 0;
				while($linha = $result->fetch(PDO::FETCH_ASSOC)){
					$usuarios[$i]['id'] = $linha['id'];
                    $usuarios[$i]['usuario'] = $linha['usuario'];
                    $usuarios[$i]['email'] = $linha['email'];
                    $usuarios[$i]['vinculo'] = $linha['vinculo'];
                    $usuarios[$i]['privilegio'] = $linha['privilegio'];
                    $usuarios[$i]['empresa'] = $linha['empresa'];
                    $usuarios[$i]['ativo'] = $linha['ativo'];
                    $i++;
                }    
            }
            return $usuarios;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function retornaDadosDoUsuarioPorId($id){
        try{
            /*parent::con();
            $query = "SELECT usuario,email,vinculo,privilegio,empresa FROM $this->tabela WHERE id={$id}";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            parent::fecharCon();
            $usuario = null;
            if ($result){ 
                $i = 0;
                while ($linha= mysql_fetch_assoc($result)){
                    $usuario[$i]['usuario'] = $linha['usuario'];
                    $usuario[$i]['email'] = $linha['email'];
                    $usuario[$i]['vinculo'] = $linha['vinculo'];
                    $usuario[$i]['privilegio'] = $linha['privilegio'];
                    $usuario[$i]['empresa'] = $linha['empresa'];
                    $i++;
                }    
            }
            return $usuario;*/
            $query = "SELECT $this->campos FROM $this->tabela WHERE id = ?";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $id);
            $result->execute();
            
            $usuario = $result->fetch(PDO::FETCH_ASSOC);
         
            return $usuario;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function comparaSenha($id,$senhaAtual){
        try{
           /* parent::con();
            $query = "SELECT senha FROM $this->tabela WHERE id={$id}";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            $linha = mysql_fetch_assoc($result);
            $senhaDefinida = $linha['senha'];
            if($senhaDefinida == $senhaAtual){
                parent::fecharCon();
                return true;
            }else{
                parent::fecharCon();
                return false;
            }*/
            
            $query = "SELECT $this->campos FROM $this->tabela WHERE id = ?";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $id);
            $result->execute();
            
            $senhaDefinida = $result->fetch(PDO::FETCH_ASSOC);
            
            if($senhaDefinida['senha'] == $senhaAtual){
                return true;
            }else{
                return false;
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function consultaPontosPorPeriodo($usuarioId, $dataInicio, $dataFinal){
        try{
            /*parent::con();
            $query = " SELECT $this->campos FROM $this->tabela WHERE usuario_id=$usuarioId AND (dia BETWEEN '".$dataInicio."' AND '".$dataFinal."') ORDER BY dia,usuario";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            parent::fecharCon();
            $pontos = null;
            if ($result){ 
                $i = 0;
                while ($linha= mysql_fetch_assoc($result)){
                    $pontos[$i]['usuario'] = $linha['usuario'];
                    $pontos[$i]['dia'] = $linha['dia'];
                    $pontos[$i]['entrada'] = $linha['entrada'];
                    $pontos[$i]['entrada_almoco'] = $linha['entrada_almoco'];
                    $pontos[$i]['volta_almoco'] = $linha['volta_almoco'];
                    $pontos[$i]['saida'] = $linha['saida'];
                    $i++;
                }    
            }
            return $pontos;*/
            $query = " SELECT $this->campos FROM $this->tabela WHERE usuario_id = ? AND dia BETWEEN ? AND ? ORDER BY dia,usuario";
			$result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuarioId);
            $result->bindParam(2, $dataInicio);
            $result->bindParam(3, $dataFinal);
            $result->execute();
            
			$pontos = null;
			if ($result){ 
                $i = 0;
                while ($linha = $result->fetch(PDO::FETCH_ASSOC) ){
                    $pontos[$i]['usuario'] = $linha['usuario'];
                    $pontos[$i]['dia'] = $linha['dia'];
                    $pontos[$i]['entrada'] = $linha['entrada'];
                    $pontos[$i]['entrada_almoco'] = $linha['entrada_almoco'];
                    $pontos[$i]['volta_almoco'] = $linha['volta_almoco'];
                    $pontos[$i]['saida'] = $linha['saida'];
                    $i++;
                }    
            }
            return $pontos;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    //Necessário para o consultar pontos do administrador
    public function buscaIdUsuario($usuario){
        try{
            /*$id = '';
            parent::con();
            $query = " SELECT id FROM $this->tabela WHERE usuario='".$usuario."' ";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());           
            parent::fecharCon();
            if ($result){
                $id = mysql_fetch_array($result);
                return $id['id'];
            }else{
                return false;
            }*/
            $id = '';
            $query = "SELECT $this->campos FROM $this->tabela WHERE usuario = ?";
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $usuario);
            $result->execute();
            
            if($result){
                $id = $result->fetch(PDO::FETCH_ASSOC);
                return $id['id'];
            }else{
                return false;
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
   }
    
    public function consultaPontosPorPeriodoEUsuario($empresa,$usuarioId, $usuario ,$dataInicio, $dataFinal, $privilegio){
        try{
            /*parent::con();
            if ( empty($usuario) ){
                if ($privilegio == 'Administrador'){
                    $query = " SELECT $this->campos FROM $this->tabela WHERE usuarios.empresa='".$empresa."' AND dia BETWEEN '".$dataInicio."' AND '".$dataFinal."' ORDER BY dia,usuario";
                }else if( $privilegio == 'Super Admin' ){
                    $query = " SELECT $this->campos FROM $this->tabela WHERE dia BETWEEN '".$dataInicio."' AND '".$dataFinal."' ORDER BY dia,usuario";
                }
                
            }else{
                if ($privilegio == 'Administrador'){
                    $query = " SELECT $this->campos FROM $this->tabela WHERE usuarios.empresa='".$empresa."' AND pontos.usuario_id=$usuarioId AND ( dia BETWEEN '".$dataInicio."' AND '".$dataFinal."')";
                }else if( $privilegio == 'Super Admin' ){
                    $query = " SELECT $this->campos FROM $this->tabela WHERE pontos.usuario_id=$usuarioId AND ( dia BETWEEN '".$dataInicio."' AND '".$dataFinal."')";
                }
                
            }
            //echo $query;
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            parent::fecharCon();
            $pontos = null;
            if ($result){ 
                $i = 0;
                while ($linha= mysql_fetch_assoc($result)){
                    $pontos[$i]['usuario'] = $linha['usuario'];
                    $pontos[$i]['dia'] = $linha['dia'];
                    $pontos[$i]['entrada'] = $linha['entrada'];
                    $pontos[$i]['entrada_almoco'] = $linha['entrada_almoco'];
                    $pontos[$i]['volta_almoco'] = $linha['volta_almoco'];
                    $pontos[$i]['saida'] = $linha['saida'];
                    $pontos[$i]['vinculo'] = $linha['vinculo'];
                    $i++;
                }    
            }
            return $pontos;*/
            
            if ( empty($usuario) ){
                if ($privilegio == 'Administrador'){
                    $query = "SELECT $this->campos FROM $this->tabela WHERE dia BETWEEN ? AND ? AND usuarios.empresa = ? ORDER BY dia,usuario";
                }else if( $privilegio == 'Super Admin' ){
                    $query = "SELECT $this->campos FROM $this->tabela WHERE dia BETWEEN ? AND ? ORDER BY dia,usuario";
                }
            }else{
                if ($privilegio == 'Administrador'){
                    $query = "SELECT $this->campos FROM $this->tabela WHERE dia BETWEEN ? AND ? AND usuarios.empresa = ? AND pontos.usuario_id = ?";
                }else if( $privilegio == 'Super Admin' ){
                    $query = "SELECT $this->campos FROM $this->tabela WHERE dia BETWEEN ? AND ? AND pontos.usuario_id = ?";
                }   
            }
            $result = $this->conexao->prepare($query);            
            $result->bindParam(1, $dataInicio);
            $result->bindParam(2, $dataFinal);
            if($privilegio == 'Administrador'){
                $result->bindParam(3, $empresa);
            }
            if( !empty($usuario) ){
                if($privilegio == 'Administrador'){
                        $result->bindParam(4, $usuarioId);
                }else if( $privilegio == 'Super Admin' ){
                        $result->bindParam(3, $usuarioId);
                }
            }
            $result->execute();
            
            $pontos = null;
            if ($result){ 
                $i = 0;
                while ($linha = $result->fetch(PDO::FETCH_ASSOC) ){
                    $pontos[$i]['usuario'] = $linha['usuario'];
                    $pontos[$i]['dia'] = $linha['dia'];
                    $pontos[$i]['entrada'] = $linha['entrada'];
                    $pontos[$i]['entrada_almoco'] = $linha['entrada_almoco'];
                    $pontos[$i]['volta_almoco'] = $linha['volta_almoco'];
                    $pontos[$i]['saida'] = $linha['saida'];
                    $pontos[$i]['vinculo'] = $linha['vinculo'];
                    $i++;
                }    
            }
            return $pontos;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
     public function retornaTodosOsUsuarios(){
        try{
            /*parent::con();
            $query = "SELECT id,ativo,dataCadastro FROM $this->tabela WHERE ativo='S' AND privilegio!='Super Admin'";
           
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            parent::fecharCon();
            $usuarios = null;
            if ($result){ 
                $i = 0;
                while ($linha= mysql_fetch_assoc($result)){
                    $usuarios[$i]['id'] = $linha['id'];
                    $usuarios[$i]['ativo'] = $linha['ativo'];
                    $usuarios[$i]['dataCadastro'] = $linha['dataCadastro'];
                    $i++;
                }    
            }
            return $usuarios;*/
            $query = "SELECT $this->campos FROM $this->tabela WHERE ativo='S' AND privilegio!='Super Admin'";
            $result = $this->conexao->prepare($query);
            $result->execute();
            
            $usuarios = null;
            if ($result){ 
                $i = 0;
                while ($linha = $result->fetch(PDO::FETCH_ASSOC) ){
                    $usuarios[$i]['id'] = $linha['id'];
                    $usuarios[$i]['ativo'] = $linha['ativo'];
                    $usuarios[$i]['dataCadastro'] = $linha['dataCadastro'];
                    $i++;
                }    
            }
            return $usuarios;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }

    
}
?>
