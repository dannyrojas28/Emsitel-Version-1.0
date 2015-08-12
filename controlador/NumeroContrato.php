<?php

include "../modelo/Datos.php";
$formato=$_POST['formato_contrato'];
$numero=$_POST['num_contrato'];
$clase=new Datos();
session_start();
  if($_SESSION['cliente'] == "personal"){
    $result=$clase->NumeroContrato($formato, $numero);
    if(mysqli_num_rows($result) > 0){
        echo "true";
    }else{
        echo "false";
    }
  }else{
      $result=$clase->NumeroContratoEmpresarial($formato, $numero);
        if(mysqli_num_rows($result) > 0){
            echo "true";
        }else{
            echo "false";
        }
  }
?>
