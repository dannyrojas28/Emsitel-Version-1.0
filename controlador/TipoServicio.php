<?php
include "../modelo/Datos.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$datosF=new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
$tipo=$_POST['tiposervicio'];
$cod_ubi=$datosF->cod_ubi;
if($_SESSION['cliente'] == "personal"){
    if(mysqli_num_rows($datosF->TipoServicio($tipo,$cod_ubi)) > 0){
        echo "true";
    }else{
        echo "false";
    }
}else{
     if(mysqli_num_rows($datosF->TipoServicioEmp($tipo,$cod_ubi)) > 0){
        echo "true";
    }else{
        echo "false";
    }
}