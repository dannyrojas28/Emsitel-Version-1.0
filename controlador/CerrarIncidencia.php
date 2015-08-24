<?php
include "../modelo/Datos.php";
session_start();
$datosF = new Datos();
$solucion_inc=$_POST['solucion1'];
$archivoCer_inc=$_POST['valorImagen1'];
$fechaCer_inc=$_POST['fechaCerr1'];
$horaCer_inc=$_POST['horaCerr1'];
$cod_inc=$_POST['codigosoporte1'];
if($datosF->con == 1 ){
    $tablaSoporte="SoportesIncidenciasPersonales";
}else{
    $tablaSoporte="SoportesIncidenciasEmpresas";
} 
if($datosF->CerrarIncidencia($tablaSoporte,$cod_inc,$solucion_inc,$archivoCer_inc,$fechaCer_inc,$horaCer_inc)){
     echo "true+";?> <br><center>
                        <font color="green"><h1><span class='glyphicon glyphicon-ok'></span></h1> la Incidencia Se Cerro Correctamente</font><br>
                        +<button type="button" onclick="CargarSubContenido('controlador/ServiciosTecnicos')" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-thumbs-up"></span>  Verificar</button>
        <?php   
        }else{
                echo 'false+<font color="red"><h1><span class="glyphicon glyphicon-remove"></span></h1>  No se ha podido Actualizar la Incidencia</font><br><button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
            }

?>