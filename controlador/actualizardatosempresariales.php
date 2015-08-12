<?php

include ('../modelo/Datos.php');

session_start();
$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}

$nit=$_POST['nit_empresa'];
     $nombre_emp=$_POST['nombre_empresa'];
     $nombrerep_emp=$_POST['nombre_representane'];
     $municipio_emp=$_POST['municipio_empresa'];
     $direccion_emp=$_POST['direccion_empresa'];
     $telefono_per=$_POST['telefono_persona'];
    $celular_per=$_POST['celular_persona'];
    $email_per=$_POST['email_persona'];
    
    $datosF->nit=$nit;
    $datosF->nombre_emp=$nombre_emp;
    $datosF->nombrerep_emp=$nombrerep_emp;
    $datosF->municipio_emp=$municipio_emp;
    $datosF->direccion_emp = $direccion_emp;
    $datosF->telefonoper = $telefono_per;
    $datosF->celularper = $celular_per;
    $datosF->emailper =$email_per;

if($datosF->ActualizarDatosEmpresariales($datosF->nit,$datosF->nombre_emp,$datosF->nombrerep_emp,$datosF->direccion_emp,$datosF->municipio_emp,$datosF->telefonoper,$datosF->celularper,$datosF->emailper,$datosF->cod_emp)){
    
   echo "<font color='green'>  <h1><span class='glyphicon glyphicon-ok'>  </span></h1> Se actualizo Correctamente<font>";
   $_SESSION['datosF']=$datosF;
}else{
    echo "<font color='red'>  <h1><span class='glyphicon glyphicon-remove'>  </span></h1> No se ha podido Actualizar<font>";
}