<?php
include ('../modelo/Datos.php');

session_start();


$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}

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
$var=0;

if($datosF->ActualizarServiciosPersonales($tiposervicio,$estadoservicio,$formato_contrato,$num_contrato,$fecha_inicio,$fecha_fin,$asesorcomercial,$descripcion_contrato,$datosF->cod_ser)){
                if($datosF->ActualizarDetallesPersonales($tipoconex,$velocidadmax,$velocidadmin,$nodo,$antena,$datosF->cod_det)){
                    $comparadoripB=$_POST['Backbone'];
                    for($i=1;$i <= $comparadoripB;$i++){
                        if(empty($_POST['direccionIp'.$i])){
                            $cod=0;
                        }else{
                            $cod=$_POST['direccionIp'.$i];
                        }
                         $direccionIp1=$_POST['rangoipB'.$i].$cod;
                         $descripcionIp1=$_POST['descripcionIp'.$i];
                         $cod_bak=$_POST['cod_bak'.$i];
                         if($datosF->ActualizarIpBackPersonales($direccionIp1,$descripcionIp1,$cod_bak)){
                            $var=1;
                         }else{
                            $var=0;
                         }

                    }
                    $comparadoripBack=$_POST['comparadoripb'];
                    if($comparadoripBack != 1){
                        for($i=$comparadoripB+1;$i <= $comparadoripBack;$i++){
                            if(empty($_POST['direccionIp'.$i])){
                                $cod=0;
                                }else{
                                    $cod=$_POST['direccionIp'.$i];
                                }
                             $direccionIp1=$_POST['rangoipB'.$i].$cod;
                             $descripcionIp1=$_POST['descripcionIp'.$i];
                             if($datosF->RegistrarIpBackbonePer($direccionIp1,$descripcionIp1,$datosF->cod_det)){
                                $var=1;
                             }else{
                                $var=0;
                             }

                        }
                    }
                    
                    $comparadoripC=$_POST['Cliente'];
                    for($i=1;$i <= $comparadoripC;$i++){
                        if(empty($_POST['direccionIpc'.$i])){
                            $cod=0;
                        }else{
                            $cod=$_POST['direccionIpc'.$i];
                        }
                         $direccionIpc1=$_POST['rangoipC'.$i].$cod;
                         $cod_cli=$_POST['cod_cli'.$i];
                         $descripcionIpc1=$_POST['descripcionIpc'.$i];
                         if($datosF->ActualizarIpClientesPersonales($direccionIpc1,$descripcionIpc1,$cod_cli)){
                            $var=1;
                         }else{
                            $var=0;
                         }

                    }
                    $comparadoripCli=$_POST['comparadoripc'];
                    if($comparadoripCli != 1){
                        for($i=$comparadoripC+1;$i <= $comparadoripCli;$i++){
                            if(empty($_POST['direccionIpc'.$i])){
                            $cod=0;
                        }else{
                            $cod=$_POST['direccionIpc'.$i];
                        }
                             $direccionIpc1=$_POST['rangoipC'.$i].$cod;
                             $descripcionIpc1=$_POST['descripcionIpc'.$i];
                             if($datosF->RegistrarIpClientePer($direccionIpc1,$descripcionIpc1,$datosF->cod_det)){
                                $var=1;
                             }else{
                                $var=0;
                             }
                        }
                    }
                    $comparadoripE=$_POST['Equipo'];
                      for($i=1;$i <= $comparadoripE;$i++){
                         $direccionIpe1=$_POST['elementoE'.$i];
                         $cod_equ=$_POST['cod_equ'.$i];
                         $direccionmac=$_POST['direccionmac'.$i];
                         $descripcionIpe1=$_POST['descripcionserial'.$i];
                         if($datosF->ActualizarIpEquiposPersonales($direccionIpe1,$direccionmac,$descripcionIpe1,$cod_equ)){
                            $var=1;
                         }else{
                            $var=0;
                         }

                    }
                     $comparadoripEqui=$_POST['comparadoripEq'];
                     if($comparadoripEqui != 1){
                          for($i=$comparadoripE+1;$i <= $comparadoripEqui;$i++){
                             $direccionIpe1=$_POST['elementoE'.$i];
                             $direccionmac=$_POST['direccionmac'.$i];
                             $descripcionIpe1=$_POST['descripcionserial'.$i];
                             if($datosF->RegistrarIpEquipoPer($direccionIpe1,$direccionmac,$descripcionIpe1,$datosF->cod_det)){
                                $var=1;
                             }else{
                                $var=0;
                             }

                        }
                     }
                    if($var != 0){
                        echo "true+";?> <br><center>
                <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  se Actualizo Correctamente</font><br>
                +<button type="button" onclick=' ListarServiciosActualizarDatos("controlador/listarServicioActualizar")' class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-chevron-left"></span>  Verificar</button>
                    <?php
                    }else{
                        echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
                    }
                	
                }else{
                    echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
                }
        }else{
            echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br>+<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
        }