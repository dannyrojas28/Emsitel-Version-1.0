<?php

/*
    Document   : modelo/conexion.php
    Created on : 2015-07-21 11:28 am
    Author     : dannyrojas
    Description:
    Purpose of the stylesheet follows.
    To change this template use Tools | Templates.
*/
class Conexion{
    public function EstablecerConexion(){
        $conexion=mysqli_connect('localhost','root','dannyrojas','emsitel');
        if(!$conexion){
            echo "no se ha podido conectar ala base de datos"or die(mysqli_error($conexion));
        }
       return $conexion;
    }
}
?>