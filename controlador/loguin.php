<?php
include "../modelo/usuario.php";
/*
    Document   : controlador/loguin.php
    Created on : 2015-07-21 11:33 am
    Author     : dannyrojas
    Description:
    Purpose of the stylesheet follows.
    To change this template use Tools | Templates.
*/
$usuario=$_POST['usuario'];
$password=$_POST['password'];

$clase= new Usuario();
$query=$clase->Loguin($usuario,$password);
    while($row=mysqli_fetch_array($query)){
        if($row['usuario'] == $usuario and $row['password'] == $password){
        	 if(!isset($_SESSION)) 
    			{ 
       
            session_start();
            $_SESSION['login']=$usuario;
            $_SESSION['documento']=$row['documento_usu'];
            $_SESSION['rol']=$row['rol'];
            $_SESSION['nombres']=" ".$row['nombre_usu']."  ".$row['apellido_usu'];
            $_SESSION['imagen']=$row['imagen_usu'];
                 echo "true";
   			 } 
        }else{
            echo "false";
        }
    }

?>