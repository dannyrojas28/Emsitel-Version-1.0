<?php
/*se hace el include, para poder llamar la clase, crear el objeto y llamar los metodos que  se declaran en ella*/
include ('../../modelo/Datos.php');
/*se inicializa la funcion de session*/
session_start();
/*creo el objeto*/
$datosF = new Datos();
/* si la variable de session datosF es diferente a vacio guardara,se guardaran los datos del variable $_SESSION['datosF'] en la variable $datosF */
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
/*si nombre_ubicacion es diferente a vacio es porque contiene algo, entonces se sabe que proviene del formulario ubicaciones de servicio*/
if(!empty($_POST['nombre_ubicacion'])){
    /*recibo todos los datos de los campos del formulario de ubicaciones de servicio*/ 
     $nombre_ubi=$_POST['nombre_ubicacion'];
     $direccion_ubi=$_POST['direccion_ubicacion'];
     $municipio_ubi=$_POST['municipio_ubicacion'];
     $nombre_per_ubi=$_POST['nombre_per_ubicacion'];
     $apellido_per_ubi=$_POST['apellido_per_ubicacion'];
     $telefono_ubi=$_POST['telefono_per_ubicacion'];
     $celular_ubi=$_POST['celular_per_ubicacion'];
     $email_ubi=$_POST['email_per_ubicacion'];
    /*guardo los valores en el metodo segun sea su nombre, asi ya no va a ser vacio si no que tomara el valor que se recibe */
    $datosF->nombreubi = $nombre_ubi;
    $datosF->direccionubi = $direccion_ubi;
    $datosF->municipioubi = $municipio_ubi;
    $datosF->nombre_per_ubi = $nombre_per_ubi;
    $datosF->apellido_per_ubi = $apellido_per_ubi;
    $datosF->telefono_per_ubi= $telefono_ubi;
    $datosF->celular_per_ubi = $celular_ubi;
    $datosF->email_per_ubi = $email_ubi;
    
    
    
}
/*le asigno un nuevo valor a la variable de sesion, la cual contendra todos los datos del formulario representados en el objeto datosF*/
$_SESSION['datosF'] = $datosF;

?>
<script type="text/javascript">
  
    var tiposervicio=$('#tiposervicios').val();
    var estadoservicio=$('#estadoservicios').val();
    var formato_contrato=$('#formatocontrato').val();
    var fecha1=$('#fecha1').val();
    var fecha2=$('#fecha2').val();
    var asesorcomercial=$('#asesorcomercials').val();
      document.getElementById('tiposervicio').value=tiposervicio;
      document.getElementById('estadoservicio').value=estadoservicio;
      document.getElementById('formato_contrato').value=formato_contrato;
      document.getElementById('fecha_inicio').value=fecha1;
      document.getElementById('fecha_fin').value=fecha2;
      document.getElementById('asesorcomercial').value=asesorcomercial;
</script>
<?php
   if($_SESSION['cliente'] == "personal"){
?>
    <ol class="breadcrumb">
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_personales')">Clientes Personales</a></li>
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatospersonales')">Nuevo Registro</a></li>
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatospersonales')">Datos Personales</a></li>
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_ubicacion')">Ubicacion del servicio</a></li>
      <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_servicio')">Tipo de servicio</a></li>
    </ol> 
    <div id="container">

        <div id="row">
            <div id="bn">
                <h2>Registrar Cliente Personal</h2>
<?php
   }else{
?>
         
    <ol class="breadcrumb">
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_empresariales')">Clientes Empresariales</a></li>
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatosEmpresariales')">Nuevo Registro</a></li>
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatosEmpresariales')">Datos Empresariales</a></li>
        <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_ubicacion')">Ubicacion del servicio</a></li>
      <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_servicio')">Tipo de servicio</a></li>
    </ol> 
    <div id="container">

        <div id="row">
            <div id="bn">
                <h2>Registrar Cliente Empresarial</h2>       
<?php

   }
?>           
                <hr class="hrcolor">
            <div id="form-rg-p" class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-7">
            <form method="post" enctype="multipart/form-data" name="formulario3">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Tipo del servicio</h3>
                    </div>
                </div>
                
                <div class="form-group">   
                    <div class="col-sm-6 col-xs-12"><br>
                         <label id="examplePass">Tipo de Servicio</label>
                        <select class="form-control" id="tiposervicio" name="tiposervicio"> 
                            <?php
                                $query=$datosF->BD_TiposServicio();
                                while($row=mysqli_fetch_array($query)){
                                    echo '<option value="'.$row['cod_tp'].'">'.$row['nombre_tp'].'</option>';
                                }
                            ?>
                           
                        </select>
                         <span id="span_tipo"></span>
                    </div>
                     
                    <div class="col-sm-6 col-xs-12"><br>
                         <label id="examplePass">Estado del Servicio</label>
                        <select class="form-control" id="estadoservicio" name="estadoservicio">
                            <?php
                                $query2=$datosF->BD_EstadoServicio();
                                while($row=mysqli_fetch_array($query2)){
                                    echo '<option value="'.$row['cod_est'].'">'.$row['nombre_est'].'</option>';
                                }
                            ?>
                        </select>
                         <span id="span_estado"></span>
                         <br>
                    </div>
                  </div>
                <input type="hidden" id="tiposervicios" value="<?php echo $datosF->tiposervicio; ?>">
                <input type="hidden" id="estadoservicios" value="<?php echo $datosF->estadoservicio; ?>">
                <input type="hidden" id="formatocontrato" value="<?php echo $datosF->formato_contrato; ?>">
                
                <?php
                   
                ?>
                <div class="form-group">  
                     <div class="col-sm-6 col-xs-12"><br>
                        <label id="examplePass">Formato de Contrato</label>
                        <select class="form-control" id="formato_contrato" name="formato_contrato">
                             <?php
                                if($_SESSION['cliente'] == "personal"){
                                    $query2=$datosF->BD_FormatosContrato();
                                    while($row=mysqli_fetch_array($query2)){
                                        echo '<option value="'.$row['cod_for'].'">'.$row['nombre_for'].'</option>';
                                    }
                                }else{
                                        $query2=$datosF->FormatoContratoEmpresas();
                                        while($row=mysqli_fetch_array($query2)){
                                            echo '<option value="'.$row['cod_forE'].'">'.$row['nombre_forE'].'</option>';
                                        }
                                    }
                            ?>
                        </select>
                        <span id="span_formato"></span>
                    </div>
                    <div class="col-sm-6 col-xs-12"><br>
                        <label id="examplePass">Nº de Contrato</label>
                        <input type="number" onkeyup="NumeroContrato()"class="form-control" placeholder="Nº Contrato" name="num_contrato" id="num_contrato" value="<?php echo $datosF->num_contrato; ?>">
                        <span id="span_num"></span><br>
                    </div>
                </div>
               
                               
                            
                        
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Fecha De Inicio</label>
                        <input type="date" class="form-control"  id="fecha_inicio" name="fecha_inicio">
                        <span id="span_fechai"></span>
                        
                    </div>
               
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Fecha De Fin</label>
                        <input type="date" class="form-control"  id="fecha_fin" name="fecha_fin">
                        <span id="span_fechaf"></span>
                        <br>
                    </div>
                </div>
                <input type="hidden" id="fecha1" value="<?php echo $datosF->fechaini; ?>">
                <input type="hidden" id="fecha2" value="<?php echo $datosF->fechafin; ?>">
                
                 <div class="col-xs-12">
                         <label id="examplePass">Asesor Comercial</label>
                        <select class="form-control" id="asesorcomercial" name="asesorcomercial">
                            <option value="0">Seleccione el Asesor</option>
                            <?php
                                $query2=$datosF->BD_AsesorComercial();
                                while($row=mysqli_fetch_array($query2)){
                                    echo '<option value="'.$row['cod_ase'].'">'.$row['nombre_ase']." ".$row['apellido_ase'].'</option>';
                                }
                            ?>
                        </select>
                         <span id="span_asesor"></span>
                         <br>
                    </div>
                <input type="hidden" id="asesorcomercials" value="<?php echo $datosF->asesorcomercial; ?>">
                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <label id="examplePass">Descripcion Comercial</label>
                        <textarea type="text" class="form-control"  id="descripcion_contrato" name="descripcion_contrato"  placeholder="descripcion del contrato" rows="10" cols="40"><?php echo $datosF->descripcion_contrato; ?></textarea>
                        <span id="span_telefono"></span><br>
                    </div>
                </div>
                <div class="col-xs-12">
                    <center><br>
                        <button type="button" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_ubicacion')" class="btn btn-success"> <span class="glyphicon glyphicon-chevron-left"></span>   Regresar</button>
                          <button type="button" id="btn" name="btn" onclick="SiguienteServicio()" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Siguiente</button> <br>
                        <br>               
                    </center>
                    <br>
                </div>
            </form>
            </div>
            <div id="forms" class="col-md-2 col-lg-3">
              
            </div>
            <div id="hid">
                
            </div>
        </div>
        <div id="espa" class="col-xs-12">
                          
                        </div>
    </div>
    
</div>