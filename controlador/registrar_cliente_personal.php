<?php
include '../modelo/Datos.php';

session_start();
$datosF = new Datos();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
     $tipoconex=$_POST['tipoconexion'];
     $velocidadmax=$_POST['velocidadmax'];
     $velocidadmin=$_POST['velocidadmin'];
     $nodo=$_POST['nodo'];
     $antena=$_POST['antena'];
     
     $datosF->tipoconexion=$tipoconex;
     $datosF->velocidadmax=$velocidadmax;
     $datosF->velocidadmin=$velocidadmin;
     $datosF->nodo=$nodo;
     $datosF->antena=$antena;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$query=$datosF->SelectCodDatPer();
if(mysqli_num_rows($query) > 0){
	while($row=mysqli_fetch_array($query)){
		$cod_dat=$row['cod_cli']+1;
	}
}else{
	$cod_dat=1;
}
$query2=$datosF->SelectCodUbiPer();
if(mysqli_num_rows($query2) > 0){
	while($row=mysqli_fetch_array($query2)){
		$cod_ubi=$row['cod_ubi']+1;
	}
}else{
	$cod_ubi=1;
}
$query3=$datosF->SelectCodSerPer();
if(mysqli_num_rows($query3) > 0){
	while($row=mysqli_fetch_array($query3)){
		$cod_ser=$row['cod_ser']+1;
	}
}else{
	$cod_ser=1;
}
$query4=$datosF->SelectCodDetPer();
if(mysqli_num_rows($query4) > 0){
	while($row=mysqli_fetch_array($query4)){
		$cod_det=$row['cod_det']+1;
	}
}else{
	$cod_det=1;
}
if($datosF->RegistrarDatosPersonales($cod_dat,$datosF->cedula, $datosF->nombre1, $datosF->nombre2, $datosF->apellido1, $datosF->apellido2, $datosF->direccionper, $datosF->municipioper, $datosF->telefonoper, $datosF->celularper, $datosF->emailper)){
    if($datosF->RegistrarUbicacionServicio($cod_ubi,$datosF->nombreubi,$datosF->direccionubi,$datosF->municipioubi,$datosF->nombre_per_ubi,$datosF->apellido_per_ubi,$datosF->telefono_per_ubi,$datosF->celular_per_ubi,$datosF->email_per_ubi,$cod_dat)){
    		if($datosF->RegistrarTipoServicio($cod_ser,$datosF->tiposervicio,$datosF->estadoservicio,$datosF->formato_contrato,$datosF->num_contrato,$datosF->fechaini,$datosF->fechafin,$datosF->asesorcomercial,$datosF->descripcion_contrato,$cod_ubi)){
        		if($datosF->RegistrarDetalleServicio($cod_det,$datosF->tipoconexion,$datosF->velocidadmax,$datosF->velocidadmin,$datosF->nodo,$datosF->antena,$cod_ser)){
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
                   

                
        		}else{
        			$var=0;}
        	}else{
                        $var=0;}
    }else{
                        $var=0;  }
}else{
                       $var=0;}

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

                       echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>';
                    }

