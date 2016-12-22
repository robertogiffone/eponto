<?php
class Conexao {
    private $con,$servidor='localhost',$usuario='root',$senha='',$bd='robertog_eponto';
    
    public function conexao(){
        try{
        	$conexao = new PDO("mysql:host=$this->servidor;dbname=$this->bd", $this->usuario, $this->senha );
            return $conexao;
        }catch (PDOException $e){
            echo 'Erro na conexao ao banco de dados';
        }
        
    }

}
?>
