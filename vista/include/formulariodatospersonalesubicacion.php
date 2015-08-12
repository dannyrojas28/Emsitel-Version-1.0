<?php

include ('../../modelo/Datos.php');
session_start();
$datosF = new Datos();

if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
?>
<form method="post" enctype="multipart/form-data" name="formulario2">
                <div class="row"> 
                    <div id="titulo-form" class="col-xs-12">

                    
                    
                    </div>
                    <div id="titulo-form" class="col-xs-12">
                        <?php
                            if($_SESSION['cliente'] == "personal"){
                       ?>
                                <a  onclick="VerificarCedula()" class="float" id="cursor"> <span class="glyphicon glyphicon-remove-circle"></span></a>
                       <?php
                            }else{
                       ?>
                           <a  onclick="VerificarNit()" class="float" id="cursor"> <span class="glyphicon glyphicon-remove-circle"></span></a>
                        <?php
                            }
                        ?>
                   <h2>Ubicacion del servicio </h2>
                    
                      
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-12"><br>
                        <label id="examplePass">Nombre de ubicacion/ sede</label>
                            <input type="text" class="form-control"  placeholder="Nombre de ubicacion/ sede" name="nombre_ubicacion" id="nombre_ubicacion" value="">
                        <span id="span_nombre"></span><br>
                     </div>
                </div>
               
                <div class="form-group">
                    <div class=" col-xs-12">
                        <label id="examplePass">Direccion</label>
                        <input type="text" class="form-control" placeholder="Direccion del Servicio" name="direccion_ubicacion" id="direccion_ubicacion" value="">
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
                                    echo '<option value="'.$row['cod_mun'].'">'.$row['nombre_mun'].'</option>';
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
                        <input type="texto" class="form-control" placeholder="Nombre persona" name="nombre_per_ubicacion"id="nombre_per_ubicacion" value="">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Apellido persona" name="apellido_per_ubicacion" id="apellido_per_ubicacion" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Telefono</label>
                        <input type="number" class="form-control" placeholder="Numero telefonico " name="telefono_per_ubicacion" id="telefono_per_ubicacion"value="">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Celular</label>
                        <input type="number" onkeyup="CelularUbiPer()" class="form-control" placeholder="Numero Celular" name="celular_per_ubicacion" id="celular_per_ubicacion"value="">
                        <span id="span_celular"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        
                    
                    <label id="examplePass">Email</label>
                    <input type="email" class="form-control" onkeyup="Email('email_per_ubicacion')" placeholder="Correo del cliente" name="email_per_ubicacion" id="email_per_ubicacion"value="">
                        <span id="span_email"></span><br>
                    </div>
                </div>
                    <div id="clf">
                <div id="servi">
               
                    <center><br>
                     <button type="button" name="btn" onclick="NuevoServicioPersonal()" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span>  Añadir Servicio</button> 
                   <?php
                     if($_SESSION['cliente'] == "personal"){
                    ?>
                         <button type="button"  name="btn" onclick="RegistrarUbicacion('controlador/registrarubicacionpersonal.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>  Registrar</button> <br>
                    <?php
                     }else{
                     ?>
                         <button type="button"  name="btn" onclick="RegistrarUbicacion('controlador/registrarubicacionempresarial.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>  Registrar</button> <br>
                    <?php
                    
                     }
                     ?>
                     <br>               
                </center>
                </div>
                 </div>
                
            </form>