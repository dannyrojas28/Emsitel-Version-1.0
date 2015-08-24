<?php
include "../modelo/Datos.php";
session_start();
$datosF = new Datos();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
$datosF->cod_ser=$_POST['cod_ser'];
$cod_Servicio=$datosF->cod_ser;
$cod_inc=$_POST['numeroInci'];
$fechaInc=$_POST['fechaInc'];
$horaInc=$_POST['horaInc'];
$creador_inc=$_POST['creador_inc'];
$responsable_inc=$_POST['TecnicoResponsable'];

$fechaCrear_sop=$_POST['fechaCre'];
$horaCrear_sop=$_POST['horaCre'];
$descripcion_sop=$_POST['descripcionServicio'];
$archivoCrear_sop=$_POST['valorImagen1'];
$solucion_sop=$_POST['solucion'];
$archivoCerrar_sop='vista/img/icono_subir.jpg';
$fechaCerrar_sop="9999-12-31";
$horaCerrar_sop="00:00:00";
$_SESSION['datosF']=$datosF;
$cod_sop=$_POST['codigosoporte1'];

if($datosF->con == 1 ){
    $tablaincidencia="Incidencias_Personales";
    $tablaSoporte="SoportesIncidenciasPersonales";
    $tablatecnico="TecnicosInciden_Personales";
}else{
    $tablaincidencia="Incidencias_Empresariales";
    $tablaSoporte="SoportesIncidenciasEmpresas";
    $tablatecnico="TecnicosInciden_Empresariales";
}

if($datosF->CrearIncidencias($tablaincidencia,$cod_inc,$creador_inc,$cod_Servicio,$responsable_inc,$fechaInc,$horaInc)){
    if($datosF-> CrearSoporte( $tablaSoporte,$cod_sop,$descripcion_sop,$archivoCrear_sop,$archivoCerrar_sop,$fechaCrear_sop,$fechaCerrar_sop,$horaCrear_sop,$horaCerrar_sop,$solucion_sop,$cod_inc)){
            $var=1;
            $tecnico=$_POST["tecnicos"];
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
                        <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  se registro Correctamente</font><br>
                        +<button type="button" onclick="MisIncidencias(<?php echo $paginas=1;?>)" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span>  Verificar</button>
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

?>