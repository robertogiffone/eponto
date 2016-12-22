<?php
class Conexao {
    private $con,$servidor='localhost',$usuario='robertog_root',$senha='2006fr',$bd='robertog_eponto';
	//com localhost deu erro
	//private $con,$servidor='127.0.0.1',$usuario='root',$senha='',$bd='robertog_eponto';
    //protected $tabela;

    public function conexao(){
        try{
        	$conexao = new PDO("mysql:host=$this->servidor;dbname=$this->bd", $this->usuario, $this->senha );
            return $conexao;
        }catch (PDOException $e){
            //echo 'Erro ao conectar = '.$e->getMessage();
            echo 'Erro na conexao ao banco de dados';
        }
        
    }

}
?>
