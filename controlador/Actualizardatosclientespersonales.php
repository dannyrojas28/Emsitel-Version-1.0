<?php
include "../modelo/Datos.php";
$datosF=new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod_cli'])){
    $datosF->cod_cli=$_POST['cod_cli'];
}


$query=$datosF->DatosClientesPersonales($datosF->cod_cli);
while ($row = mysqli_fetch_array($query)) {
    $datosF->cedula=$row['cedula_cli'];
    $datosF->nombre1=$row['nombre1_cli'];
    $datosF->nombre2=$row['nombre2_cli'];
    $datosF->apellido1=$row['apellido1_cli'];
    $datosF->apellido2=$row['apellido2_cli'];
    $datosF->direccionper=$row['direccion_cli'];
    $datosF->municipioper=$row['municipio_cli'];
    $datosF->telefonoper=$row['telefono_cli'];
    $datosF->celularper=$row['celular_cli'];
    $datosF->emailper=$row['email_cli'];
    
}

$_SESSION['datosF']=$datosF;


?>
    <ol class="breadcrumb">
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_personales')">Clientes Personales</a></li>
    <li><a id="cursor" onclick="ActualizarClientePersonal('<?php echo $datosF->cod_cli; ?>')">Actualizar Datos</a></li>
    
    </ol>
    <div class="col-lg-12">
        <div class="col-xs-4">
                <button type="button" onclick="FormActualizar('controlador/Actualizardatosclientespersonales')"class="btn btn-primary ac"><span class="glyphicon glyphicon-user "></span>  Datos Personales</button>
        </div>
        <div class="col-xs-4">
            <button type="button" onclick="FormActualizar2('controlador/listarUbicacionesActualizar')"class="btn btn-primary ac"><span class="glyphicon glyphicon-map-marker "></span>  Ubicaciones de Servicios</button>
        </div>
      <div id="servicios" class="col-xs-4">
           
        </div>
    </div>

    <div id="forms">
        <div class="col-xs-12">
         <br>
        <form method="post" enctype="multipart/form-data" name="formulario1">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Personales <span class="glyphicon glyphicon-user float"></span></h3>
                    </div>
                </div>
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-3">
                         <label id="examplePass">Cedula</label>
                           <div class="input-group">
                             <input type="number" class="form-control" onkeyup="Cedula('controlador/PresionarCedula.php')" placeholder="Numero de Cedula" name="cedula_persona" id="cedula_persona" value="<?php echo $datosF->cedula; ?>">
                             <div class="input-group-addon"><span id="span_icon"  ></span></div> 
                         </div>
                        <span id="span_cedula"></span>
                     </div>
                    <div class="col-sm-4 col-xs-12">
                        <label id="examplePass">Prime Nombre</label>
                        <input type="text" class="form-control"  placeholder="Primer Nombre" name="1nombre_persona" id="1nombre_persona" value="<?php echo $datosF->nombre1; ?>">
                        <span id="span_nombre"></span><br>
                    </div>
                    
                    <div class="col-sm-4 col-xs-12">
                        <label id="examplePass">Segundo Nombre</label>
                        <input type="text" class="form-control"  placeholder="Segundo Nombre" name="2nombre_persona"id="2nombre_persona" value="<?php echo $datosF->nombre2; ?>">
                    
                    </div>
                
                    
                </div><br>
                <div class="col-xs-12   ">
                    
            </div>
            <div class="form-group">
                    
                    <div class="col-sm-3 col-xs-12"> 
                        <label id="examplePass">Primer Apellido</label>
                        <input type="text" class="form-control"  placeholder="Primer Apellido" name="1apellido_persona" id="1apellido_persona" value="<?php echo $datosF->apellido1; ?>">
                       <span id="span_apellido"></span>
                    </div>
                    
                    <div class="col-sm-3 col-xs-12">
                        <label id="examplePass">Segundo Apellido</label>
                        <input type="text" class="form-control"  placeholder="Segundo Apellido" name="2apellido_persona" id="2apellido_persona" value="<?php echo $datosF->apellido2; ?>">
                    
                    </div>
                     <div class="col-sm-3 col-xs-12">
                        <label id="examplePass">Telefono</label>
                        <input type="number" class="form-control" placeholder="Numero telefonico" name="telefono_persona" id="telefono_persona" value="<?php echo $datosF->telefonoper; ?>">
                        <span id="span_telefono"></span><br>
                    </div>
                
                    <div class="col-sm-3">
                        
                        <label id="examplePass">Celular</label>
                        <input type="number" class="form-control" onkeyup="Celular()" placeholder="Numero Celular" name="celular_persona" id="celular_persona" value="<?php echo $datosF->celularper; ?>">
                        <span id="span_celular"></span><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-xs-12">
                        <label id="examplePass">Direccion</label>
                        <input type="text" class="form-control" placeholder="Direccion de vivienda" name="direccion_persona" id="direccion_persona" value="<?php echo $datosF->direccionper; ?>">
                        <span id="span_direccion"></span><br>
                    </div>
                   
                    <div class="col-sm-4 col-xs-12">
                         <label id="examplePass">Municipio</label>
                        <select class="form-control" name="municipio_persona" id="municipio_persona">
                            <option value="0">Seleccione el Municipio</option>
                             <?php
                                $query2=$datosF->BD_Municipios();
                                while($row=mysqli_fetch_array($query2)){
                                    if($datosF->municipioper == $row['cod_mun']){
                                        echo '<option value="'.$row['cod_mun'].'" selected>'.$row['nombre_mun'].'</option>';
                                    }else{
                                        echo '<option value="'.$row['cod_mun'].'">'.$row['nombre_mun'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                            <span id="span_municipioper"></span><br>
                        </div>
                   
          
                    <div class="col-sm-4">


                            <label id="examplePass">Email</label>
                            <input type="email" class="form-control" placeholder="Correo del cliente" name="email_persona" id="email_persona"  value="<?php echo $datosF->emailper; ?>">
                            <span id="span_email"></span><br>
                     </div>
                   
                   </div>
                
            <div class="col-xs-12">
                <center>
                    <button type="button" name="btn"onclick="ActualizarDatosPersonales('controlador/actualizardatospersonales.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-refresh"></span>   Actualizar</button> <br>
                        
                </center>
                 <hr class="hrcolor">

            </div>
            </form>
          
        </div>


    </div>
  
<script type="text/javascript">
    
</script>