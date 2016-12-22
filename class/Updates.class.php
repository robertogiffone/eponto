<?php
include_once 'Conexao.class.php';
include_once 'ConstructCon.php';
//class Updates extends Conexao implements ConstructCon {
class Updates implements ConstructCon {	
    private $tabela, $campos;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
    
    /*public function __construct($servidor, $usuario, $senha, $bd, $tabela) {
        parent::__construct($servidor, $usuario, $senha, $bd);
        $this->tabela = $tabela;
    }*/
    
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
    
    public function entradaAlmoco($usuarioId, $diaAtual, $timestamp){
        try{
			/*
            //$entradaAlmoco = time()-10800-25200;
            parent::con();
            //$query = "UPDATE $this->tabela SET entrada_almoco='".$entradaAlmoco."' WHERE usuario='".$usuario."' AND dia='".$diaAtual."' AND (entrada!=0 || entrada!=NULL) AND (entrada_almoco=NULL || entrada_almoco=0) ";
            $query = "UPDATE $this->tabela SET entrada_almoco='".$timestamp."' WHERE usuario_id=$usuario_id AND dia='".$diaAtual."' AND entrada!=0";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            } else{
                parent::fecharCon();
                return false;
            }
            */
            $query ="UPDATE $this->tabela SET entrada_almoco = :timestamp WHERE usuario_id = :usuarioId AND dia = :diaAtual AND entrada != 0";
            $stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':timestamp', $timestamp);
            $stmt->bindValue(':usuarioId', $usuarioId, PDO::PARAM_INT);
			$stmt->bindValue(':diaAtual', $diaAtual);
			$atualizar = $stmt->execute();
			if($atualizar){
				return true;
			}else{
				return false;
			} 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function voltaAlmoco($usuarioId, $diaAtual, $timestamp){
        try{
			/*
            //$voltaAlmoco = time()-10800-21600;
            parent::con();
            $query = "UPDATE $this->tabela SET volta_almoco='".$timestamp."' WHERE usuario_id=$usuario_id AND dia='".$diaAtual."' AND entrada!=0 AND entrada_almoco!=0";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            } else{
                parent::fecharCon();
                return false;
            }*/
            
            $query ="UPDATE $this->tabela SET volta_almoco = :timestamp WHERE usuario_id = :usuarioId AND dia = :diaAtual AND entrada != 0 AND entrada_almoco != 0";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':timestamp', $timestamp);
            $stmt->bindValue(':usuarioId', $usuarioId, PDO::PARAM_INT);
            $stmt->bindValue(':diaAtual', $diaAtual);
            $atualizar = $stmt->execute();
            if($atualizar){
                    return true;
            }else{
                    return false;
            } 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function saida($usuarioId, $diaAtual, $timestamp){
        try{
			/*
            //$saida = time()-10800-7200;
            parent::con();
            $query = "UPDATE $this->tabela SET saida='".$timestamp."' WHERE usuario_id=$usuario_id AND dia='".$diaAtual."' AND entrada!=0 AND entrada_almoco!=0 AND volta_almoco!=0";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            } else{
                parent::fecharCon();
                return null;
            }*/
            
            $query ="UPDATE $this->tabela SET saida = :timestamp WHERE usuario_id = :usuarioId AND dia = :diaAtual AND entrada != 0 AND entrada_almoco != 0 AND volta_almoco != 0";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':timestamp', $timestamp);
            $stmt->bindValue(':usuarioId', $usuarioId, PDO::PARAM_INT);
            $stmt->bindValue(':diaAtual', $diaAtual);
            $atualizar = $stmt->execute();
            if($atualizar){
                return true;
            }else{
                return false;
            } 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function saidaEstagiario($usuarioId, $diaAtual, $timestamp){
        try{
			/*
            //$saida = time()-10800-25200;
            parent::con();
            $query = "UPDATE $this->tabela SET saida='".$timestamp."' WHERE usuario_id='".$usuario_id."' AND dia='".$diaAtual."' AND entrada!=0";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            } else{
                parent::fecharCon();
                return null;
            }*/
            //echo 'Id do usuario'.$us.'<br>';
            //echo 'Dia atual'.$diaAtual.'<br>';
            //echo 'Timestamp '.$timestamp.'<br>';
            
            $query ="UPDATE $this->tabela SET saida = :timestamp WHERE usuario_id = :usuarioId AND dia = :diaAtual AND entrada != 0";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':timestamp', $timestamp);
            $stmt->bindValue(':usuarioId', $usuarioId, PDO::PARAM_INT);
            $stmt->bindValue(':diaAtual', $diaAtual);
            $atualizar = $stmt->execute();
            if($atualizar){
                    return true;
            }else{
                    return false;
            } 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function atualizaUsuario($id,$usuario,$email,$vinculo,$privilegio,$empresa){
        try{
            /*$validaUsuario = preg_match("/^[a-zA-Z\s]+$/",$usuario);
            $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            if ( ($validaUsuario) && ($validaEmail) && ($email != '') && ($empresa != '') ){
                parent::con();
                $query = "UPDATE $this->tabela SET usuario='".$usuario."',email='".$email."',vinculo='".$vinculo."',privilegio='".$privilegio."',empresa='".$empresa."' WHERE id={$id}";
                $result = mysql_query($query, parent::getCon()) or die(mysql_error());
                if($result){
                    parent::fecharCon();
                    return true;
                }else{
                    parent::fecharCon();
                    return 'Erro ao atualizar';
                }
            }else if( empty($usuario) ){
                return 'Preencha o usuário';
            }else if ( empty($email) ){
                return 'Preencha o e-mail';
            }else if ( $validaUsuario == false ){
                return 'Preencha um usuário válido, somentes letras e espaço';
            }else if ( $validaEmail == false ){
                return 'Preencha um e-mail válido';
            }else if( empty($empresa) ){
                return 'Preencha a empresa';
            }*/
            
            $validaUsuario = preg_match("/^[a-zA-Z\s]+$/",$usuario);
            $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            if ( ($validaUsuario) && ($validaEmail) && ($email != '') && ($empresa != '') ){
                $query = "UPDATE $this->tabela SET usuario = :usuario, email = :email, vinculo = :vinculo, privilegio = :privilegio, empresa = :empresa WHERE id = :id";          
                $stmt = $this->conexao->prepare($query);
                $stmt->bindValue(':usuario', $usuario);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':vinculo', $vinculo);
                $stmt->bindValue(':privilegio', $privilegio);
                $stmt->bindValue(':empresa', $empresa);
                $stmt->bindValue(':id', $id, PDO::PARAM_INT);

                $atualizar = $stmt->execute();

                if($atualizar){
                    return true;
                }else{
                    return 'Erro na tentativa de atualizar!';
                } 
            }else if( empty($usuario) ){
                return 'Preencha o usuário';
            }else if ( empty($email) ){
                return 'Preencha o e-mail';
            }else if ( $validaUsuario == false ){
                return 'Preencha um usuário válido, somentes letras e espaço';
            }else if ( $validaEmail == false ){
                return 'Preencha um e-mail válido';
            }else if( empty($empresa) ){
                return 'Preencha a empresa';
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return null;
        }
    }
    
    public function atualizaSenha($id,$senha){
        try{
            /*parent::con();
            $query = "UPDATE $this->tabela SET senha='".$senha."' WHERE id={$id}";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            }else{
                parent::fecharCon();
                return false;
            }*/
            $query = "UPDATE $this->tabela SET senha = :senha WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':senha', $senha);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            $atualizar = $stmt->execute();

            if($atualizar){
                return true;
            }else{
                return false;
            } 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
 
    public function resetarSenha($id){
        try{
            /*parent::con();
            $senha = sha1('12345');
            $query = "UPDATE $this->tabela SET senha='".$senha."' WHERE id={$id}";
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            }else{
                parent::fecharCon();
                return false;
            }*/
            //echo $id; 
            
            $senha = sha1('12345');
            $query = "UPDATE $this->tabela SET senha = :senha WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':senha', $senha);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
   
            $atualizar = $stmt->execute();
			
            if($atualizar){
                    return true;
            }else{
                    return false;
            } 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function ativarUsuario($id){
        try{
            /*parent::con();
            $query = "UPDATE $this->tabela SET ativo='S' WHERE id={$id}";
            //echo $query;
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            }else{
                parent::fecharCon();
                return false;
            }*/
            
            $query = "UPDATE $this->tabela SET ativo = 'S' WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $atualizar = $stmt->execute();

            if($atualizar){
                return true;
            }else{
                return false;
            } 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
    public function desativarUsuario($id){
        try{
            /*parent::con();
            $query = "UPDATE $this->tabela SET ativo='N' WHERE id={$id}";
            //echo $query;
            $result = mysql_query($query, parent::getCon()) or die(mysql_error());
            if($result){
                parent::fecharCon();
                return true;
            }else{
                parent::fecharCon();
                return false;
            }*/
            
            $query = "UPDATE $this->tabela SET ativo = 'N' WHERE id = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $atualizar = $stmt->execute();
                
            if($atualizar){
                return true;
            }else{
                return false;
            } 
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
}
?>
