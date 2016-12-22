<?php
include_once 'Conexao.class.php';
include_once 'ConstructCon.php';

class Delets extends Conexao implements ConstructCon{
    private $conexao = null;
    private $tabela;
    
    public function __construct(PDO $conexao) {
        $this->conexao = $conexao;
    }
    
    public function setTabela($tabela){
        $this->tabela = $tabela;
    }
    
    public function getTabela(){
        return $this->tabela;
    }
    
    public function deletaUsuarioPorId($id){
        try{
            //parent::con();
            $this->conexao = parent::getCon();
            $query = "DELETE FROM $this->tabela WHERE id={$id}";
            //$result = mysql_query($query, parent::getCon()) or die(mysql_error());
            $result = $this->conexao->exec($query); 
            
            if ($result){
                $this->conexao = parent::fecharCon();
                return true;
            }else{
                $this->conexao = parent::fecharCon();
                return false;
            }
        //}catch(Exception $erro){
        } catch (PDOException $e) {
            echo $e->getMessage();
            echo 'Erro = '.$erro.'<br />';
            return false;
        }
    }
    
}

?>
