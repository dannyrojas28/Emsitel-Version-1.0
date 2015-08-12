<?php

include ('../modelo/Datos.php');

session_start();
$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
    $cedula=$_POST['cedula_persona'];
    $nombre1=$_POST['1nombre_persona'];
    $nombre2=$_POST['2nombre_persona'];
    $apellido1=$_POST['1apellido_persona'];
    $apellido2=$_POST['2apellido_persona'];
    $direccion_per=$_POST['direccion_persona'];
    $municipio_per=$_POST['municipio_persona'];
    $telefono_per=$_POST['telefono_persona'];
    $celular_per=$_POST['celular_persona'];
    $email_per=$_POST['email_persona'];
    
    $datosF->cedula = $cedula;
    $datosF->nombre1 = $nombre1;
    $datosF->nombre2 = $nombre2;
    $datosF->apellido1 = $apellido1;
    $datosF->apellido2 = $apellido2;
    $datosF->direccionper = $direccion_per;
    $datosF->telefonoper = $telefono_per;
    $datosF->municipioper=$municipio_per;
    $datosF->celularper = $celular_per;
    $datosF->emailper =$email_per;
    
   

if($datosF->ActualizarDatosCliPer($datosF->cedula, $datosF->nombre1, $datosF->nombre2, $datosF->apellido1, $datosF->apellido2, $datosF->direccionper, $datosF->municipioper, $datosF->telefonoper, $datosF->celularper, $datosF->emailper,$datosF->cod_cli))
{
    echo "<font color='green'>  <h1><span class='glyphicon glyphicon-ok'>  </span></h1> Se actualizo Correctamente<font>";
   $_SESSION['datosF']=$datosF;
}else{
    echo "<font color='red'>  <h1><span class='glyphicon glyphicon-remove'>  </span></h1> No se ha podido Actualizar<font>";
}

?>
