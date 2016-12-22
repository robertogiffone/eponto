<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Horario
 *
 * @author Roberto
 */
class Ponto {
    private $usuarioId, $usuario, $dia, $entrada;
    //private $entradaAlmoco, $voltaAlmoco, $saida;
    
    
    //public function __construct($usuarioId, $usuario, $dia, $entrada) {
    //    $this->usuarioId = $usuarioId;
    //    $this->usuario = $usuario;
    //    $this->dia = $dia;
    //    $this->entrada = $entrada;        
    //}
    
    public function setUsuarioId($usuarioId){
        $this->usuarioId = $usuarioId;
    }
    
    public function getUsuarioId(){
        return $this->usuarioId;
    }
    
    public function setUsuario($usuario){
        $this->usuario = $usuario;
    }
    
    public function getUsuario(){
        return $this->usuario;
    }

    public function setDia($dia) {
        $this->dia = $dia;
    }

    public function getDia() {
        return $this->dia;
    }
    
    public function setEntrada($entrada) {
        $this->entrada = $entrada;
    }
    
    public function getEntrada() {
        return $this->entrada;
    }

    /*public function setEntradaAlmoco($entradaAlmoco) {
        $this->entradaAlmoco = $entradaAlmoco;
    }
    
    public function getEntradaAlmoco() {
        return $this->entradaAlmoco;
    }

    public function setVoltaAlmoco($voltaAlmoco) {
        $this->voltaAlmoco = $voltaAlmoco;
    }
    
    public function getVoltaAlmoco() {
        return $this->voltaAlmoco;
    }

    public function setSaida($saida) {
        $this->saida = $saida;
    }

    public function getSaida() {
        return $this->saida;
    }*/

}

?>
