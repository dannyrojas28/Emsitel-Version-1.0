<?php
include "../modelo/Datos.php";
session_start();
$datosF = new Datos();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
$datosF->cod_ser=$_POST['cod_ser'];
$datosF->con=$_POST['con'];
echo  $datosF->con;
if($datosF->con == 1 ){
    $tablaincidencia="Incidencias_Personales";
    $tablaSoporte="SoportesIncidenciasPersonales";
   echo  $tablatecnico="TecnicosInciden_Personales";
}else{
    $tablaincidencia="Incidencias_Empresariales";
    $tablaSoporte="SoportesIncidenciasEmpresas";
    echo $tablatecnico="TecnicosInciden_Empresariales";
} 
$num=$datosF->num;
echo $num;
$cod_inc=$_POST['numeroInci'];
$responsable_inc=$_POST['TecnicoResponsable'];
if($_POST['nuevoS'] == "false"){
    if($datosF->ActualizarIncidencia($tablaincidencia,$responsable_inc,$cod_inc)){
                $cod_soporte=$_POST['codigosoporte1'];
                $descripcion_sop=$_POST['descripcionServicio1'];
                $archivoCrear_sop=$_POST['valorImagen1'];
                $solucion=$_POST['solucion1'];
                $horaCerrar=$_POST['horaCerr1'];
                $fechaCerrar=$_POST['fechaCerr1'];
                $archivoCerrar_sop="vista/img/icono_subir.jpg";
                    if($datosF->ActualizarSoporte($tablaSoporte,$descripcion_sop,$archivoCrear_sop,$solucion,$fechaCerrar,$horaCerrar,$archivoCerrar_sop,$cod_soporte)){
                        if($datosF->BorrarTecnicosIncidencias($tablatecnico,$cod_soporte)){
                                $var=1;

                                    $tecnico=$_POST["tecnicos1"];
                                    $count = count($tecnico);
                                    for ($j = 0; $j < $count; $j++) {
                                        if($datosF->InsertarTecnicos($tablatecnico,$tecnico[$j],$cod_soporte)){
                                            $var=1;
                                        }else{
                                            $var=2;
                                        }
                                    }
                            }else{
                                $var=2;
                              }
                    }else{
                        $var=2;
                    } 

        $_SESSION['datosF']=$datosF;
          }else{
            $var=2;
        }                                                                                                                                                                                                                                                                                                                                                                                      
                    if($var == 1){
                        $datosF->archivo="";
                    echo "true+";?> <br><center>
                                <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  Se Actualizo Correctamente</font><br>
                                +<button type="button" onclick="MisIncidencias(<?php echo $paginas=1;?>)" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span>  Verificar</button>
                <?php   
                }else{
                        echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido Actualizar la Incidencia</font><br><button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
                    }

}else{
 $cod_sop=$_POST['codigosoporte'.$num];
$fechaCrear_sop=$_POST['fechaCre'.$num];
$horaCrear_sop=$_POST['horaCre'.$num];
$descripcion_sop=$_POST['descripcionServicio'.$num];
$archivoCrear_sop=$_POST['valorImagen'.$num];
$solucion_sop=$_POST['solucion'.$num];
$archivoCerrar_sop='vista/img/icono_subir.jpg';
$fechaCerrar_sop="9999-12-31";
$horaCerrar_sop="00:00:00";
$_SESSION['datosF']=$datosF;
if($datosF->ActualizarIncidencia($tablaincidencia,$responsable_inc,$cod_inc)){
    if($datosF-> CrearSoporte($tablaSoporte,$cod_sop,$descripcion_sop,$archivoCrear_sop,$archivoCerrar_sop,$fechaCrear_sop,$fechaCerrar_sop,$horaCrear_sop,$horaCerrar_sop,$solucion_sop,$cod_inc)){
           
        $var=1;
            $tecnico=$_POST["tecnicos1"];
            $count = count($tecnico);
                for ($i = 0; $i < $count; $i++) {
                    if($datosF->InsertarTecnicos($tablatecnico,$tecnico[$i],$cod_sop)){
                        $var=1;
                    }else{
                        $var=2;
                    }
                }

            if($var == 1){
                $datosF->archivo="";
            echo "true+";?> <br><center>
                        <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  se Actualizo Correctamente</font><br>
                        +<button type="button" onclick="MisIncidencias(<?php echo $datosF->pagina;?>)" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span>  Verificar</button>
                <?php   
             }else{
                    echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar</font><br><button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
            }
    }else{
            echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar</font><br><button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
        }

}else{

    echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar</font><br><button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
}

}
?>


