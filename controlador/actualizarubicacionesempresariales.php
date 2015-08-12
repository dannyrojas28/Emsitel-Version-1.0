<?php
include ('../modelo/Datos.php');

session_start();


$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
$nombre_ubi=$_POST['nombre_ubicacion'];
     $direccion_ubi=$_POST['direccion_ubicacion'];
     $municipio_ubi=$_POST['municipio_ubicacion'];
     $nombre_per_ubi=$_POST['nombre_per_ubicacion'];
     $apellido_per_ubi=$_POST['apellido_per_ubicacion'];
     $telefono_ubi=$_POST['telefono_per_ubicacion'];
     $celular_ubi=$_POST['celular_per_ubicacion'];
     $email_ubi=$_POST['email_per_ubicacion'];
    
    $datosF->nombreubi = $nombre_ubi;
    $datosF->direccionubi = $direccion_ubi;
    $datosF->municipioubi = $municipio_ubi;
    $datosF->nombre_per_ubi = $nombre_per_ubi;
    $datosF->apellido_per_ubi = $apellido_per_ubi;
    $datosF->telefono_per_ubi= $telefono_ubi;
    $datosF->celular_per_ubi = $celular_ubi;
    $datosF->email_per_ubi = $email_ubi;
    
    
if($datosF->ActualizarUbicacionesCliEmp($datosF->nombreubi, $datosF->direccionubi, $datosF->municipioubi, $datosF->nombre_per_ubi, $datosF->apellido_per_ubi, $datosF->telefono_per_ubi, $datosF->celular_per_ubi, $datosF->email_per_ubi, $datosF->cod_ubi)){

 
    echo "<font color='green'>  <h1><span class='glyphicon glyphicon-ok'>  </span></h1> Se actualizo Correctamente<font>";
   $_SESSION['datosF']=$datosF;
}else{
    echo "<font color='red'>  <h1><span class='glyphicon glyphicon-remove'>  </span></h1> No se ha podido Actualizar<font>";
} 

?>
