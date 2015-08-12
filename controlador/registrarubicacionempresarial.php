<?php
include ('../modelo/Datos.php');

session_start();


$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}

$cod_dat=$datosF->cod_emp;
$nombre_ubi=$_POST['nombre_ubicacion'];
$direccion_ubi=$_POST['direccion_ubicacion'];
$municipio_ubi=$_POST['municipio_ubicacion'];
$nombre_per_ubi=$_POST['nombre_per_ubicacion'];
$apellido_per_ubi=$_POST['apellido_per_ubicacion'];
$telefono_ubi=$_POST['telefono_per_ubicacion'];
$celular_ubi=$_POST['celular_per_ubicacion'];
$email_ubi=$_POST['email_per_ubicacion'];

 $query2=$datosF->SelectCodUbiEmp();
if(mysqli_num_rows($query2) > 0){
	while($row=mysqli_fetch_array($query2)){
		$cod_ubi=$row['cod_ubi_emp']+1;
	}
}

if($datosF->RegistrarUbicacionesEmpresariales($cod_ubi,$nombre_ubi,$direccion_ubi,$municipio_ubi,$datosF->nombre_per_ubi,$apellido_per_ubi,$telefono_ubi,$celular_ubi,$email_ubi,$cod_dat)){
    	 echo "true+";?> <br><center>
                <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  se registro Correctamente</font><br>
                +<button type="button" onclick="CargarSubContenido('vista/include/nuevo_registro_empresarial')" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-chevron-left"></span>  Verificar</button>
                    <?php
                         $nit=$datosF->nit;
                    $_SESSION['datosF']="";
                    $datosF->nit=$nit;
                    $_SESSION['datosF']=$datosF;
    }else{
    	echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
                   }

?>
