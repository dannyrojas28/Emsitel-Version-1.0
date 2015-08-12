<?php

include ('../../modelo/Datos.php');
session_start();
$datosF = new Datos();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod_ubicacion'])){
    $datosF->cod_ubi=$_POST['cod_ubicacion'];
}

if($_SESSION['cliente']== "personal"){
    $query=$datosF->UbicacionesClientesPersonales($datosF->cod_ubi);
    while($row=  mysqli_fetch_array($query)){
    $datosF->cod_ubi=$row['cod_ubi'];
    $datosF->nombreubi = $row['nombre_ubi']; 
    $datosF->direccionubi = $row['direccion_ubi'];
    $datosF->municipioubi = $row['municipio_ubi'];
    $datosF->nombre_per_ubi = $row['nombre_per_sitio_ubi'];
    $datosF->apellido_per_ubi = $row['apellido_per_sitio_ubi'];
    $datosF->telefono_per_ubi = $row['telefono_per_sitio_ubi'];
    $datosF->celular_per_ubi = $row['celular_per_sitio_ubi'];
    $datosF->email_per_ubi = $row['email_per_sitio_ubi'];
}
}else{
    $query=$datosF->UbicacionesClientesEmpresariales($datosF->cod_ubi);
    while($row=  mysqli_fetch_array($query)){
    $datosF->cod_ubi=$row['cod_ubi_emp'];
    $datosF->nombreubi = $row['nombreubi_emp']; 
    $datosF->direccionubi = $row['direccionubi_emp'];
    $datosF->municipioubi = $row['municipioubi_emp'];
    $datosF->nombre_per_ubi = $row['nombre_per_sitio_ubi'];
    $datosF->apellido_per_ubi = $row['apellido_per_sitio_ubi'];
    $datosF->telefono_per_ubi = $row['telefono_per_sitio_ubi'];
    $datosF->celular_per_ubi = $row['celular_per_sitio_ubi'];
    $datosF->email_per_ubi = $row['email_per_sitio_ubi'];
    }
}


$_SESSION['datosF']=$datosF;

?>
<?php
if($_SESSION['cliente']== "personal"){
    
?>

<script type="text/javascript">
document.getElementById('servicios').innerHTML='<button type="button"  onclick="ListarServiciosActualizarDatos(\'controlador/listarServicioActualizar\')" class="btn btn-success ac"><span class="glyphicon glyphicon-list-alt "></span>  Tipos de Servicios </button>';

</script>
    <?php
}else{
?>
<script type="text/javascript">
document.getElementById('servicios').innerHTML='<button type="button"  onclick="ListarServiciosActualizarDatos(\'controlador/listarServicioActualizarEmpresas\')" class="btn btn-success ac"><span class="glyphicon glyphicon-list-alt "></span>  Tipos de Servicios </button>';

</script>

<?php
}
?>
<br>
<div id="titulo-form" class="col-xs-12">
                    
                        <h3>Ubicacion del servicio  <span class="glyphicon glyphicon-map-marker float"></span></h3>
                    
                      
                    </div>
<form id="forms" method="post" enctype="multipart/form-data" name="formulario2">
   
                <div class="row"> 
                    
                </div>
                
                
                
                 <div class="form-group">
                     <br>
                    <div class="col-xs-6">
                        <label id="examplePass">Nombre de ubicacion/ sede</label>
                            <input type="text" class="form-control"  placeholder="Nombre de ubicacion/ sede" name="nombre_ubicacion" id="nombre_ubicacion" value="<?php echo $datosF->nombreubi;?>">
                        <span id="span_nombre"></span><br>
                     </div>
               
                    <div class=" col-xs-6">
                        <label id="examplePass">Direccion</label>
                        <input type="text" class="form-control" placeholder="Direccion del Servicio" name="direccion_ubicacion" id="direccion_ubicacion" value="<?php echo $datosF->direccionubi;?>">
                        <span id="span_direccion"></span><br>
                    </div>
                </div>
                
                <div class="form-group">   
                    <div class="col-xs-12">
                         <label id="examplePass">Municipio</label>
                        <select class="form-control" name="municipio_ubicacion" id="municipio_ubicacion"  >
                            <option value="0">Seleccione el Municipio</option>
                            <?php
                                $query2=$datosF->BD_Municipios();
                                while($row=mysqli_fetch_array($query2)){
                                    if($datosF->municipioubi == $row['cod_mun']){
                                        echo '<option value="'.$row['cod_mun'].'" selected>'.$row['nombre_mun'].'</option>';
                                    }else{
                                        echo '<option value="'.$row['cod_mun'].'" >'.$row['nombre_mun'].'</option>';
                                    }
                                }
                            ?>
                        </select><span id="span_municipio"></span><br>
                    </div>
                </div>
                <div class="col-xs-12">
                    
                        <label id="examplePass">Persona en el sitio</label>
                    <hr class="hrcolor">
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Nombres</label>
                        <input type="texto" class="form-control" placeholder="Nombre persona" name="nombre_per_ubicacion"id="nombre_per_ubicacion" value="<?php echo $datosF->nombre_per_ubi;?>">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Apellido persona" name="apellido_per_ubicacion" id="apellido_per_ubicacion" value="<?php echo $datosF->apellido_per_ubi;?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Telefono</label>
                        <input type="number" class="form-control" placeholder="Numero telefonico " name="telefono_per_ubicacion" id="telefono_per_ubicacion"value="<?php echo $datosF->telefono_per_ubi?>">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Celular</label>
                        <input type="number" class="form-control" onkeyup="CelularUbiPer()"placeholder="Numero Celular" name="celular_per_ubicacion" id="celular_per_ubicacion"value="<?php echo $datosF->celular_per_ubi?>">
                        <span id="span_celular"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        
                    
                    <label id="examplePass">Email</label>
                    <input type="email" class="form-control" onkeyup="Email('email_per_ubicacion')" placeholder="Correo del cliente" name="email_per_ubicacion" id="email_per_ubicacion"value="<?php echo $datosF->email_per_ubi?>">
                        <span id="span_email"></span><br>
                    </div>
                </div>
                    <div id="clf">
                <div id="servi">
               
                    <center><br>
                        
                        <?php
                        
                        if($_SESSION['cliente']== "personal"){
                           
                        ?>
                            <button type="button" id="btn" onclick="ActualizarUbicacionesPersonales('controlador/actualizarubicacionespersonales.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-refresh"></span>   Actualizar</button> <br>
                        <?php 
                            }  else {
                                
                            
                        ?>
                            <button type="button" id="btn" onclick="ActualizarUbicacionesPersonales('controlador/actualizarubicacionesempresariales.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-refresh"></span>   Actualizar</button> <br>
                            
                         <?php
                            }
                         ?>
                            <br>               
                </center>
                </div>
                 </div>
    
            </form>



    