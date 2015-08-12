<?php
include ('../modelo/Datos.php');

session_start();


$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
    
     $query=$datosF->SelectCodDatEmp();
if(mysqli_num_rows($query) > 0){
	while($row=mysqli_fetch_array($query)){
		$cod_dat=$row['cod_emp']+1;
	}
}else{
	$cod_dat=1;
}
$query2=$datosF->SelectCodUbiEmp();
if(mysqli_num_rows($query2) > 0){
	while($row=mysqli_fetch_array($query2)){
		$cod_ubi=$row['cod_ubi_emp']+1;
	}
}else{
	$cod_ubi=1;
}

if($datosF->RegistrarDatosEmpresariales($cod_dat,$datosF->nit,$datosF->nombre_emp,$datosF->nombrerep_emp,$datosF->direccion_emp,$datosF->municipio_emp,$datosF->telefonoper,$datosF->celularper,$datosF->emailper)){
    if($datosF->RegistrarUbicacionesEmpresariales($cod_ubi,$datosF->nombreubi,$datosF->direccionubi,$datosF->municipioubi,$datosF->nombre_per_ubi,$datosF->apellido_per_ubi,$datosF->telefono_per_ubi,$datosF->celular_per_ubi,$datosF->email_per_ubi,$cod_dat)){
            echo "true+";?> <br><center>
                <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  se registro Correctamente</font><br>
                +<button type="button" onclick="CargarSubContenido('vista/include/nuevo_registro_empresarial')" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-chevron-left"></span>  Verificar</button>
                    <?php
                         $nit=$datosF->nit;
                    $_SESSION['datosF']="";
                    $datosF->nit=$nit;
                    $_SESSION['datosF']=$datosF;
                    }else{

                        echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>';
                    }
}else{
            echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>';
}    
