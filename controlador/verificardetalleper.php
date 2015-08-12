<?php

include ('../modelo/Datos.php');

session_start();


$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}

     $tipoconex=$_POST['tipoconexion'];
     $velocidadmax=$_POST['velocidadmax'];
     $velocidadmin=$_POST['velocidadmin'];
     $nodo=$_POST['nodo'];
     $antena=$_POST['antena'];
     
	 $datosF->tipoconexion=$tipoconexion;
     $datosF->velocidadmax=$velocidadmax;
     $datosF->velocidadmin=$velocidadmin;
     $datosF->nodo=$nodo;
     $datosF->antena=$antena;
    

$_SESSION['datosF'] = $datosF;
?>

