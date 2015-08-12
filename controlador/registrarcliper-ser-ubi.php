<?php
include ('../modelo/Datos.php');

session_start();


$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}

$cod_dat=$datosF->cod_cli;


//*recibo los datos de formulario de ubicaciones personales
$nombre_ubi=$_POST['nombre_ubicacion'];
$direccion_ubi=$_POST['direccion_ubicacion'];
$municipio_ubi=$_POST['municipio_ubicacion'];
$nombre_per_ubi=$_POST['nombre_per_ubicacion'];
$apellido_per_ubi=$_POST['apellido_per_ubicacion'];
$telefono_ubi=$_POST['telefono_per_ubicacion'];
$celular_ubi=$_POST['celular_per_ubicacion'];
$email_ubi=$_POST['email_per_ubicacion'];

//*recibo los datos del formulario de servicio personales
 $tiposervicio=$_POST['tiposervicio'];
     $estadoservicio=$_POST['estadoservicio'];
     $formato_contrato=$_POST['formato_contrato'];
     $num_contrato=$_POST['num_contrato'];
     $fecha_inicio=$_POST['fecha_inicio'];
     $fecha_fin=$_POST['fecha_fin'];
     $asesorcomercial=$_POST['asesorcomercial'];
     $descripcion_contrato=$_POST['descripcion_contrato'];

//*recibo los datos del formulario de detalles del servicio personal

     $tipoconex=$_POST['tipoconexion'];
     $velocidadmax=$_POST['velocidadmax'];
     $velocidadmin=$_POST['velocidadmin'];
     $nodo=$_POST['nodo'];
     $antena=$_POST['antena'];
//*obtengo el codigo a insertar del ubicaciones
 $query2=$datosF->SelectCodUbiPer();
if(mysqli_num_rows($query2) > 0){
	while($row=mysqli_fetch_array($query2)){
		$cod_ubi=$row['cod_ubi']+1;
	}
}
//*obtengo el codigo a insertar del servicios
$query3=$datosF->SelectCodSerPer();
if(mysqli_num_rows($query3) > 0){
    while($row=mysqli_fetch_array($query3)){
        $cod_ser=$row['cod_ser']+1;
    }
}else{
    $cod_ser=1;
}
//*obtengo el codigo a insertar del detalles
$query4=$datosF->SelectCodDetPer();
if(mysqli_num_rows($query4) > 0){
    while($row=mysqli_fetch_array($query4)){
        $cod_det=$row['cod_det']+1;
    }
}else{
    $cod_det=1;
}
$var=0;
    //*llamo a la funcion registrar ubicacion y le envio los parametros
	if($datosF->RegistrarUbicacionServicio($cod_ubi,$nombre_ubi,$direccion_ubi,$municipio_ubi,$nombre_per_ubi,$apellido_per_ubi,$telefono_ubi,$celular_ubi,$email_ubi,$cod_dat)){
        if($datosF->RegistrarTipoServicio($cod_ser,$tiposervicio,$estadoservicio,$formato_contrato,$num_contrato,$fecha_inicio,$fecha_fin,$asesorcomercial,$descripcion_contrato,$cod_ubi)){
                if($datosF->RegistrarDetalleServicio($cod_det,$tipoconex,$velocidadmax,$velocidadmin,$nodo,$antena,$cod_ser)){
                    $comparadoripBack=$_POST['comparadoripb'];
                    for($i=1;$i <= $comparadoripBack;$i++){
                         $direccionIp1=$_POST['rangoipB'.$i].$_POST['direccionIp'.$i];
                         $descripcionIp1=$_POST['descripcionIp'.$i];
                         if($datosF->RegistrarIpBackbonePer($direccionIp1,$descripcionIp1,$cod_det)){
                            $var=1;
                         }else{
                            $var=0;
                         }

                    }
                    $comparadoripCli=$_POST['comparadoripc'];
                    for($i=1;$i <= $comparadoripCli;$i++){
                         $direccionIpc1=$_POST['rangoipC'.$i].$_POST['direccionIpc'.$i];
                         $descripcionIpc1=$_POST['descripcionIpc'.$i];
                         if($datosF->RegistrarIpClientePer($direccionIpc1,$descripcionIpc1,$cod_det)){
                            $var=1;
                         }else{
                            $var=0;
                         }

                    }

                    $comparadoripEqui=$_POST['comparadoripEq'];
                      for($i=1;$i <= $comparadoripEqui;$i++){
                         $direccionIpe1=$_POST['elementoE'.$i];
                         $direccionmac=$_POST['direccionmac'.$i];
                         $descripcionIpe1=$_POST['descripcionserial'.$i];
                         if($datosF->RegistrarIpEquipoPer($direccionIpe1,$direccionmac,$descripcionIpe1,$cod_det)){
                            $var=1;
                         }else{
                            $var=0;
                         }

                    }

                    if($var != 0){
                       echo "true+";?> <br><center>
                <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  se registro Correctamente</font><br>
                +<button type="button" onclick="CargarSubContenido('vista/include/nuevo_registro_personal')" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-chevron-left"></span>  Verificar</button>
                    <?php
                         $cedula=$datosF->cedula;
                    $_SESSION['datosF']="";
                    $datosF->cedula=$cedula;
                    $_SESSION['datosF']=$datosF;
                    }else{
                        echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
                    }
                	
                }else{
                        echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';  }
        }else{
                        echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
        }
    }else{
    	  echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';  }

?>
