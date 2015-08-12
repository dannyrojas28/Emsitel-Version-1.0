<?php
include "../modelo/Datos.php";
$datosF=new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod_emp'])){
$datosF->cod_emp=$_POST['cod_emp'];
}   

$query=$datosF->DatosClientesEmpresariales($datosF->cod_emp);
while ($row = mysqli_fetch_array($query)) {
    $datosF->nit=$row['nitcedula_emp'];
    $datosF->nombre_emp=$row['nombre_emp'];
    $datosF->nombrerep_emp=$row['representantelegal_emp'];
    $datosF->direccion_emp=$row['direccion_emp'];
    $datosF->municipio_emp=$row['municipio_emp'];
    $datosF->telefonoper=$row['telefono_emp'];
    $datosF->celularper=$row['celular_emp'];
    $datosF->emailper=$row['email_emp'];
    
}
$_SESSION['datosF']=$datosF;

?>

    <ol class="breadcrumb">
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_empresariales')">Clientes Empresariales</a></li>
    <li><a id="cursor" onclick="ActualizarClienteEmpresarial('<?php echo $datosF->cod_emp; ?>')">Actualizar Datos</a></li>
    
</ol>
    <div class="col-lg-12">
        <div class="col-xs-4">
            <button type="button" onclick="FormActualizar('controlador/Actualizardatosclientesempresariales')"class="btn btn-primary ac"><span class="glyphicon glyphicon-user "></span>  Datos Empresariales</button>
         </div>
        <div class="col-xs-4">  
            <button type="button" onclick="FormActualizar2('controlador/listarUbicacionesActualizarEmpresas')"class="btn btn-primary ac"><span class="glyphicon glyphicon-map-marker "></span>  Ubicaciones de Servicios</button>
         </div>
         <div id="servicios" class="col-xs-4">
           
        </div>
    </div>
    <div id="forms" >
        <div class="col-xs-12">
            <br>
        <form method="post" enctype="multipart/form-data" name="formulario1">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Empresariales</h3>
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     <br>
                    <div class="col-xs-3">
                        <label id="examplePass">Nit/Cedula</label>
                         <div class="input-group">
                                <input type="text" class="form-control"  onkeyup="Cedula('controlador/PresionarNit.php')" placeholder="Nit o Numero de Cedula" name="nit_empresa" id="cedula_persona" value="<?php echo $datosF->nit; ?>">
                                <div class="input-group-addon"><span id="span_icon" class="glyphicon glyphicon-ok"></span></div> 
                         </div>
                        <span id="span_cedula"></span>
                     </div>
                    <div class=" col-xs-3">
                        <label id="examplePass"> Nombre Empresa</label>
                        <input type="text" class="form-control"  placeholder="Nombre Empresa" name="nombre_empresa" id="1nombre_persona" value="<?php echo $datosF->nombre_emp; ?>">
                     <span id="span_nombre"></span>
                    </div>
                    
                    <div class=" col-xs-3">
                        <label id="examplePass"> Representante Legal</label>
                        <input type="text" class="form-control"  placeholder="Nombre Representante Legal" name="nombre_representane" id="1apellido_persona" value="<?php echo $datosF->nombrerep_emp; ?>">
                     <span id="span_apellido"></span>
                    </div>
                    
                    <div class="col-xs-3">
                        
                    
                        <label id="examplePass">Email</label>
                        <input type="email" class="form-control" placeholder="Correo del cliente" name="email_persona" id="email_persona"  value="<?php echo $datosF->emailper; ?>">
                        <span id="span_email"></span><br>
                   </div>
                </div>
            <div class="col-xs-12">
                
            </div>
                <div class="form-group">
                    <div class="col-sm-3 col-xs-12">
                        <label id="examplePass">Telefono</label>
                        <input type="number" class="form-control" placeholder="Numero telefonico" name="telefono_persona" id="telefono_persona" value="<?php echo $datosF->telefonoper; ?>">
                        <span id="span_telefono"></span><br>
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        
                        <label id="examplePass">Celular</label>
                        <input type="number" class="form-control" Onkeyup="Celular()" placeholder="Numero Celular" name="celular_persona" id="celular_persona" value="<?php echo $datosF->celularper; ?>">
                        <span id="span_celular"></span><br>
                    </div>
               
                
                    <div class="col-sm-3 col-xs-12">
                        <label id="examplePass">Direccion</label>
                        <input type="text" class="form-control" placeholder="Direccion de vivienda" name="direccion_empresa" id="direccion_empresa" value="<?php echo $datosF->direccion_emp; ?>">
                        <span id="span_direccion"></span>
                    </div>  
                    <div class="col-sm-3 col-xs-12">
                         <label id="examplePass">Municipio</label>
                        <select class="form-control" name="municipio_empresa" id="municipio_persona">
                            <option value="0">Seleccione el Municipio</option>
                             <?php
                                $query2=$datosF->BD_Municipios();
                                while($row=mysqli_fetch_array($query2)){
                                    if( $datosF->municipio_emp == $row['cod_mun']){
                                         echo '<option value="'.$row['cod_mun'].'" selected>'.$row['nombre_mun'].'</option>';
                                
                                    }else{
                                       echo '<option value="'.$row['cod_mun'].'">'.$row['nombre_mun'].'</option>';
                                 
                                    }
                                }
                            ?>
                        </select>
                        <span id="span_municipioper"></span>
                    </div>
                </div>
            <div class="col-xs-12">
                
            </div>
                
                
              <div class="col-xs-12">
                <center>
                     <button type="button" id="btn" name="btn" onclick="ActualizarDatosPersonales('controlador/actualizardatosempresariales.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-refresh"></span>   Actualizar</button> <br>
                    <br>               
                </center>
            </div>
            </form>
                
        </div>
    </div>
  
<script type="text/javascript">
    
</script>
