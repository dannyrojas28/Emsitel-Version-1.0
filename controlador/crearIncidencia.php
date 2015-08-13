<?php
include "../modelo/Datos.php";
session_start();
$datosF = new Datos();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
$datosF->cod_ser=$_POST['cod_ser'];
$datosF->con=$_POST['con'];
$cod_inc=$_POST['numeroInci'];
$creador_inc=$_POST['creador_inc'];
$fechaCre_inc=$_POST['fechaCre'];
$horaCre_inc=$_POST['horaCre'];
$cod_Servicio=$datosF->cod_ser;
$descripcion_inc=$_POST['descripcionServicio'];
$responsable_inc=$_POST['TecnicoResponsable'];
if(!empty($datosF->archivo)){
    $archivoCre_inc=$datosF->archivo;
}else{
    $archivoCre_inc="vista/img/icono_subir.jpg";
}
$solucion_inc=$_POST['solucion'];
$archivoCer_inc='vista/img/icono_subir.jpg';
$fechaCer_inc="0000-00-00";
$horaCer_inc="00:00:00";
$_SESSION['datosF']=$datosF;
if($datosF->CrearIncidencias($cod_inc,$creador_inc,$fechaCre_inc,$horaCre_inc,$cod_Servicio,$descripcion_inc,$responsable_inc,$archivoCre_inc,$solucion_inc,$archivoCer_inc,$fechaCer_inc,$horaCer_inc)){
    $tecnico=$_POST["tecnicos"];
    $count = count($tecnico);
    for ($i = 0; $i < $count; $i++) {
        if($datosF->InsertarTecnicos($tecnico[$i],$cod_inc)){
            $var=1;
        }else{
            $var=2;
        }
    }
    
    if($var == 1){
    echo "true+";?> <br><center>
                <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1>  se registro Correctamente</font><br>
                +<button type="button" onclick="MisIncidencias(<?php echo $paginas=1;?>)" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span>  Verificar</button>
<?php   
}else{
        echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br><button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
    }

}else{

    echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido registrar dir ip</font><br><button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
}

?>