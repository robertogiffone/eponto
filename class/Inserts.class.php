<?php
include_once 'Conexao.class.php';
include_once 'ConstructCon.php';
include_once 'Usuario.class.php';
include_once 'Ponto.class.php';
//class Inserts extends Conexao implements ConstructCon{
class Inserts implements ConstructCon{

    private $tabela, $campos;
    private $conexao = null; //Variável que irá receber a conexão do banco de dados
	
    /*public function __construct($servidor,$usuario,$senha,$bd,$tabela){
        parent::__construct($servidor,$usuario,$senha,$bd);
        $this->tabela=$tabela;
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
    
    public function cadastroConta(Usuario $user){
        try{
            /*$usuario = $user->getUsuario();
            $senha = $user->getSenha();
            $email = $user->getEmail();
            $vinculo = $user->getVinculo();
            $privilegio = $user->getPrivilegio();
            $empresa = $user->getEmpresa();
            //$letra = "/^[a-zA-Z]$/"; 
            $validaUsuario = preg_match("/^[a-zA-Z\s]+$/",$usuario);
            $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            
            if ( ($validaUsuario) && ($validaEmail) && ($email !='') && (!empty($empresa)) ){
                parent::con();
                $query="INSERT INTO $this->tabela VALUES(NULL,'".$usuario."', '".$senha."',
                    '".$email."','".$vinculo."','".$privilegio."','".$empresa."','S','".date('Y-m-d H:i:s')."')";
                mysql_query($query, parent::getCon()) or die(mysql_error());
                parent::fecharCon();
                return true;
            }else if ( $validaUsuario == false ){
                return 'Preencha um usuário válido, somentes letras e espaço';
            }else if ( ($validaEmail == false) || empty($email) ){
                return 'Preencha um e-mail válido';
            }else if ( empty($empresa) ){
                return 'Preencha a empresa';  
            }*/
            $usuario = $user->getUsuario();
            $senha = $user->getSenha();
            $email = $user->getEmail();
            $vinculo = $user->getVinculo();
            $privilegio = $user->getPrivilegio();
            $empresa = $user->getEmpresa();
            $validaUsuario = preg_match("/^[a-zA-Z\s]+$/",$usuario);
            $validaEmail = preg_match("/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/",$email);
            
            if ( ($validaUsuario) && ($validaEmail) && ($email !='') && (!empty($empresa)) ){
                //$query="INSERT INTO $this->tabela VALUES(NULL,'".$usuario."', '".$senha."',
                //    '".$email."','".$vinculo."','".$privilegio."','".$empresa."','S','".date('Y-m-d H:i:s')."')";
                $id = NULL;
                $dataCadastro = date('Y-m-d H:i:s');
                $query = "INSERT INTO $this->tabela VALUES(:id,:usuario, :senha, :email, :vinculo, :privilegio, :empresa, 'S', :dataCadastro)";
                $stmt = $this->conexao->prepare($query); //echo $query; die;
                $stmt->bindValue(':id', $id, PDO::PARAM_NULL);
                $stmt->bindValue(':usuario', $usuario);
                $stmt->bindValue(':senha', $senha);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':vinculo', $vinculo);
                $stmt->bindValue(':privilegio', $privilegio);
                $stmt->bindValue(':empresa', $empresa);
                $stmt->bindValue(':dataCadastro', $dataCadastro); 
                $inserir = $stmt->execute(); 
                if($inserir){
                    return true;
                }else{
                    return false;
                }
            }else if ( $validaUsuario == false ){
                return 'Preencha um usuário válido, somentes letras e espaço';
            }else if ( ($validaEmail == false) || empty($email) ){
                return 'Preencha um e-mail válido';
            }else if ( empty($empresa) ){
                return 'Preencha a empresa';  
            }
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
        
    //Começei esse método dia 21/06/2013
    public function entrada(Ponto $horarios){
        try{
            /*parent::con();
            $query = "INSERT INTO $this->tabela(usuario_id,usuario,dia,entrada) VALUES('".$horarios->
                    getUsuarioId()."','".$horarios->getUsuario()."','".$horarios->getDia()."','".
                    $horarios->getEntrada()."')";
            mysql_query($query, parent::getCon()) or die(mysql_error());
            parent::fecharCon();
            return true;*/
          
            $query = "INSERT INTO $this->tabela($this->campos) VALUES(:usuarioId, :usuario, :dia, :entrada)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindValue(':usuarioId', $horarios->getUsuarioId() );
            $stmt->bindValue(':usuario', $horarios->getUsuario() );
            $stmt->bindValue(':dia', $horarios->getDia() );
            $stmt->bindValue(':entrada', $horarios->getEntrada() );
            $inserir = $stmt->execute();
            if($inserir)
                    return true;
        }catch(Exception $erro){
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }       
        
}

?>
