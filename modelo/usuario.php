<?php
include "conexion.php";
/*
    Document   : modelo/usuario.php
    Created on : 2015-07-21 11:30 am
    Author     : dannyrojas
    Description:
    Purpose of the stylesheet follows.
    To change this template use Tools | Templates.
*/
class Usuario extends Conexion{
    private $_conexion;
    function __construct(){
        $this->_conexion= new Conexion();
    }
    
    public function Loguin($usuario,$password){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT * FROM admin,usuario where admin.usuario='$usuario' AND admin.password='$password' AND admin.usuario=usuario.admin";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
}
?>