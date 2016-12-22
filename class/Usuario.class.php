<?php
/**
 * Description of Usuario
 *
 * @author Roberto
 */

class Usuario {
    private $id, $usuario, $senha, $email, $vinculo, $privilegio, $empresa;
    
    public function __construct($usuario,$email,$vinculo,$privilegio){
        $this->usuario = $usuario;
        $this->email = $email;
        $this->vinculo = $vinculo;
        $this->privilegio = $privilegio;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    
    public function getUsuario(){
        return $this->usuario;
    }
    
    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    public function getSenha(){
        return $this->senha;
    }
    
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getEmail(){
        return $this->email;
    }
    
    public function setVinculo($vinculo){
        $this->vinculo = $vinculo;
    }
    
    public function getVinculo(){
        return $this->vinculo;
    }
    
    public function setPrivilegio($privilegio){
        $this->privilegio = $privilegio;
    }
    
    public function getPrivilegio(){
        return $this->privilegio;
    }

    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
    
    public function getEmpresa(){
        return $this->empresa;
    }
    
}

?>
