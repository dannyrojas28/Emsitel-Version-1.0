<?php
include "../modelo/Datos.php";
$nit=$_POST['cedula'];
$clase=new Datos();

if(mysqli_num_rows($clase->VerificarNit($nit)) > 0){
    echo "true";
}else{
    echo "false";
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */