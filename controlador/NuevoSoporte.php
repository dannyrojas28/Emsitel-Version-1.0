<?php
include "../modelo/Datos.php";
$datosF= new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod_inc'])){
    $datosF->cod_inc=$_POST['cod_inc'];
}

if($datosF->con == 1 ){
    $tablaSoporte="SoportesIncidenciasPersonales";
}else{
    $tablaSoporte="SoportesIncidenciasEmpresas";
} 
$Soportes=$datosF->VerSoportes($tablaSoporte,$datosF->cod_inc);
 $datosF->num=mysqli_num_rows($Soportes);
$datosF->num=$datosF->num+1;
date_default_timezone_set('America/Bogota');
$datosF->fecha=date('Y-m-d');
$datosF->hora=date('H:i:s');
    $query=$datosF->VerReportes($tablaSoporte,$datosF->cod_inc);
if(mysqli_num_rows($query) > 0){
    echo "<h5><font color='red'>Debes cerrar el soporte para abrir uno nuevo</font></h5>";
}else{
    echo 'true+';?>
<br>
 <hr class="hrcolor df">
       <div class="col-xs-12">
            <h3>Soporte # <?php echo $datosF->num;?></h3>
        </div>
       <?php 
        $SacarCodigo=$datosF->SelectCodSoporte($tablaSoporte);
         if(mysqli_num_rows($SacarCodigo) > 0){
                    while($row=mysqli_fetch_array($SacarCodigo)){
                        $cod_sop=$row['cod_sop']+1;
                    }
                }else{
                    $cod_sop=1;
                }
        ?>
<script type="text/javascript">
 document.getElementById('fechaCre').focus();
</script>
        <input id="numerosopor" name="numerosopor" type="hidden" value="<?php echo $datosF->num;?>">
        <input type="hidden" name="codigosoporte<?php echo $datosF->num;?>" value="<?php echo $cod_sop;?>">
            <div class="col-xs-6"> 
                 <div class="col-xs-12"> <br>
                    <label  class="col-xs-4"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                    <div class="col-xs-8">
                        <input type="date"  readonly="readonly" class="form-control" name="fechaCre<?php echo $datosF->num;?>" id="fechaCre" value="<?php echo $datosF->fecha; ?>">
                    </div>
                 </div>
                 <div class="col-xs-12"><br>
                       <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                        <div class="col-xs-8">
                                <input type="time" readonly="readonly"  class="form-control" name="horaCre<?php echo $datosF->num;?>" id="horaCre<?php echo $datosF->num;?>"  value="<?php echo $datosF->hora; ?>">
                        </div>
                </div>
              
            <div class="col-xs-12"><br>
                <label class="col-xs-4"><span class="glyphicon glyphicon-wrench"></span> Tecnicos</label>
                <div class="col-xs-8 checkbox">
                        <?php
                                    $query=$datosF->SelectTecnicos();
                                    while($row=mysqli_fetch_array($query)){
                                        echo '<label><input type="checkbox" name="tecnicos1[]" id="tecnicos1" value="'.$row['documento_usu'].'">'.$row['nombre_usu'].' '.$row['apellido_usu'].'</label><br>';
                                    }
                               
                            ?>
                </div>
            </div>
                
                <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Descripcion del Problema</label>
                              <textarea name="descripcionServicio<?php echo $datosF->num;?>" id="descripcionServicio<?php echo $datosF->num;?>" class="form-control" rows="10" cols="40"></textarea>
                        <span id="descripcion<?php echo $datosF->num;?>"></span>
                        </div>
                    </div>
                 
        </div>
        
                <div class="col-xs-6" >
                    <div class="col-xs-12"><br>
                        <label  class="col-xs-4"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                       <div class="col-xs-8">
                            <input type="file" onchange="Archivo('verarchivo<?php echo $datosF->num;?>','controlador/Archivo.php',<?php echo $datosF->PoscImagen=$datosF->num;?>)" name="archivoIncidencia1" class="form-control" id="archivoIncidencia<?php echo $datosF->num;?>">
                        </div>
                 </div>
                    <div id="verarchivo<?php echo $datosF->num;?>" class="col-xs-offset-3 col-xs-8"><br><br>
                        <img src="vista/img/icono_subir.jpg" style='width:70%;heigth:170px;' class="img-thumbnail">
                       
                    </div>
                     <input type="hidden" name="valorImagen<?php echo $datosF->num;?>" id="valorImagen<?php echo $datosF->num;?>" value="vista/img/icono_subir.jpg">
                </div>
        <div class="col-xs-12">
            <h3>Cerrar Soporte</h3>
            <div class="col-xs-6">
                     <div class="col-xs-12"> <br>
                        <label  class="col-xs-4"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                        <div class="col-xs-8">
                            <input type="date" readonly="readonly"  class="form-control" name="fechaCerr<?php echo $datosF->num;?>" id="fechaCerr<?php echo $datosF->num;?>" value="9999-12-31">
                        </div>
                     </div>
                     <div class="col-xs-12"><br>
                           <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                            <div class="col-xs-8">
                                    <input type="time" readonly="readonly"  class="form-control" name="horaCerr<?php echo $datosF->num;?>" id="horaCerr<?php echo $datosF->num;?>"  value="9999-12-31">
                            </div>
                    </div>
                 <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Solucion</label>
                              <textarea readonly="readonly" name="solucion<?php echo $datosF->num;?>" id="solucion<?php echo $datosF->num;?>" class="form-control" rows="10" cols="40"></textarea>
                         </div>
                    </div>
                
            </div>
            <div class="col-xs-6" >
                   
                    <div class="col-xs-12"><br>
                            <label  class="col-xs-4"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                           <div class="col-xs-8">
                                <input type="file"  readonly="readonly"  name="cerrararchivoIncidencia1" class="form-control" id="cerrararchivoIncidencia1">
                            </div>
                     </div>
                    <div id="verarchivof" class="col-xs-offset-3 col-xs-8"><br><br>
                        <img src="vista/img/icono_subir.jpg" style='width:70%;heigth:170px;' class="img-thumbnail">
                    </div>
                </div>
        </div>
        <div class="col-xs-12">
                <button type="button" onclick="CrearIncidencia('controlador/ActualizarIncidencia.php',<?php echo $datosF->num;?>)" class="btn btn-info float"><span class="glyphicon glyphicon-reload"></span>  Actualizar</button>

            </div>

<?php
}
?>