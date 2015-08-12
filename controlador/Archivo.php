<?php
date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$numero=2;
$archivoIncidencia='/home/codio/workspace/emsitel/vista/archivos/';
$archivoIncidencia=$archivoIncidencia."archivo-".$numero."-".$fecha;
/*
 * To change this template use Tools | Templates.
 */
if(move_uploaded_file($_FILES['archivoIncidencia']['tmp_name'],$archivoIncidencia)){
       echo "<img src='vista/archivos/archivo-".$numero."-".$fecha."' style='width:150px;heigth:130px;'>";
}  
else{
    echo "error";
}

?>