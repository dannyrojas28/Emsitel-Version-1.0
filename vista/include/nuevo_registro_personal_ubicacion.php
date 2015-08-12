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
/*si cedula_persona es diferente a vacio es porque contiene algo, entonces se sabe que proviene del formulariodedatos personales*/
if(!empty($_POST['cedula_persona'])){
    /*recibo todos los datos de los campos del formulario de datos Personales*/    
    $cedula=$_POST['cedula_persona'];
    $nombre1=$_POST['1nombre_persona'];
    $nombre2=$_POST['2nombre_persona'];
    $apellido1=$_POST['1apellido_persona'];
    $apellido2=$_POST['2apellido_persona'];
    $direccion_per=$_POST['direccion_persona'];
    $municipio_per=$_POST['municipio_persona'];
    $telefono_per=$_POST['telefono_persona'];
    $celular_per=$_POST['celular_persona'];
    $email_per=$_POST['email_persona'];
    /*guardo los valores en el metodo segun sea su nombre, asi ya no va a ser vacio si no que tomara el valor que se recibe */
    $datosF->cedula = $cedula;
    $datosF->nombre1 = $nombre1;
    $datosF->nombre2 = $nombre2;
    $datosF->apellido1 = $apellido1;
    $datosF->apellido2 = $apellido2;
    $datosF->direccionper = $direccion_per;
    $datosF->telefonoper = $telefono_per;
    $datosF->municipioper=$municipio_per;
    $datosF->celularper = $celular_per;
    $datosF->emailper =$email_per;
    
    
}else{
    /*si nit es diferente a vacio es porque contiene algo, entonces se sabe que proviene del formulariodedatos empresariales*/
    if(!empty($_POST['nit_empresa'])){
          /*recibo todos los datos de los campos del formulario de datos Empresariales*/
     $nit=$_POST['nit_empresa'];
     $nombre_emp=$_POST['nombre_empresa'];
     $nombrerep_emp=$_POST['nombre_representane'];
     $municipio_emp=$_POST['municipio_empresa'];
     $direccion_emp=$_POST['direccion_empresa'];
     $telefono_per=$_POST['telefono_persona'];
    $celular_per=$_POST['celular_persona'];
    $email_per=$_POST['email_persona'];
    /*guardo los valores en el objeto segun sea su nombre, asi ya no va a ser vacio si no que tomara el valor que se recibe */
    $datosF->nit=$nit;
    $datosF->nombre_emp=$nombre_emp;
    $datosF->nombrerep_emp=$nombrerep_emp;
    $datosF->municipio_emp=$municipio_emp;
    $datosF->direccion_emp = $direccion_emp;
    $datosF->telefonoper = $telefono_per;
    $datosF->celularper = $celular_per;
    $datosF->emailper =$email_per;
    }
}
/*le asigno un nuevo valor a la variable de sesion, la cual contendra todos los datos del formulario representados en el objeto datosF*/
$_SESSION['datosF'] = $datosF;
/* si es un cliente personal mostrara el siguiente menu de procesos*/
if($_SESSION['cliente'] == "personal"){
?>
<ol class="breadcrumb">
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_personales')">Clientes Personales</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatospersonales')">Nuevo Registro</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatospersonales')">Datos Personales</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_ubicacion')">Ubicacion del servicio</a></li>
  
</ol> 
<div id="container">
   
    <div id="row">
        <div id="bn">
<h2>Registrar Cliente Personal</h2>
    
<?php
    
}
/* si es un cliente empresarial mostrara el siguiente menu de procesos*/
else{
?>
    <ol class="breadcrumb">
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_empresariales')">Clientes Empresariales</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatosEmpresariales')">Nuevo Registro</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/formulariodatosEmpresariales')">Datos Empresariales</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_ubicacion')">Ubicacion del servicio</a></li>
  
</ol> 
<div id="container">
   
    <div id="row">
        <div id="bn">
<h2>Registrar Cliente Empresarial</h2>
    
<?php
 }
?> <hr class="hrcolor">
            <div id="form-rg-p" class="col-xs-12  col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-7">
            <form method="post" enctype="multipart/form-data" name="formulario2">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Ubicacion del servicio</h3>
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-12"><br>
                        <label id="examplePass">Nombre de ubicacion/ sede</label>
                            <input type="text" class="form-control"  placeholder="Nombre de ubicacion/ sede" name="nombre_ubicacion" id="nombre_ubicacion" value="<?php echo $datosF->nombreubi; ?>">
                        <span id="span_nombre"></span><br>
                     </div>
                </div>
               
                <div class="form-group">
                    <div class=" col-xs-12">
                        <label id="examplePass">Direccion</label>
                        <input type="text" class="form-control" placeholder="Direccion del Servicio" name="direccion_ubicacion" id="direccion_ubicacion" value="<?php echo $datosF->direccionubi; ?>">
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
                <input type="hidden" id="select" value="<?php echo $datosF->municipioubi; ?>">
                <script type="text/javascript">
                    
                        var select=$('#select').val();
                        document.getElementById('municipio_ubicacion').value=select;
                        console.log(select);
                </script>
                <div class="col-xs-12">
                    
                        <label id="examplePass">Persona en el sitio</label>
                    <hr class="hrcolor">
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Nombres</label>
                        <input type="texto" class="form-control" placeholder="Nombre persona" name="nombre_per_ubicacion"id="nombre_per_ubicacion" value="<?php echo $datosF->nombre_per_ubi; ?>">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Apellidos</label>
                        <input type="text" class="form-control" placeholder="Apellido persona" name="apellido_per_ubicacion" id="apellido_per_ubicacion" value="<?php echo $datosF->apellido_per_ubi; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Telefono</label>
                        <input type="number" class="form-control" placeholder="Numero telefonico " name="telefono_per_ubicacion" id="telefono_per_ubicacion"value="<?php echo $datosF->telefono_per_ubi; ?>">
                        
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Celular</label>
                        <input type="number" class="form-control" onkeyup="CelularUbiPer()"placeholder="Numero Celular" name="celular_per_ubicacion" id="celular_per_ubicacion"value="<?php echo $datosF->celular_per_ubi; ?>">
                        <span id="span_celular"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        
                    
                    <label id="examplePass">Email</label>
                    <input type="email" class="form-control" onkeyup="Email('email_per_ubicacion')" placeholder="Correo del cliente" name="email_per_ubicacion" id="email_per_ubicacion"value="<?php echo $datosF->email_per_ubi; ?>">
                        <span id="span_email"></span><br>
                    </div>
                </div>
                
                   <div class="col-xs-12">
                      
                       <center><br>
                        <?php 
                            /* si es un cliente empresarial mostrara lo botones de regresar y registrar, seran iguales a los de cliente personal
                            lo que cambiara son las rutas
                            */
                            if($_SESSION['cliente'] == "empresarial"){
                         ?>     
                                   <button type="button" onclick="CargarSubContenido('vista/include/formulariodatosEmpresariales')" class="btn btn-success"> <span class="glyphicon glyphicon-chevron-left"></span>   Regresar</button>
                                <button type="button" id="btn" onclick="RegistrarUbicacion('controlador/RegistrarDatosEmpreUbicacion.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-upload"></span>   Registrar</button> 
                                
                        
                        <?php
                            }else{
                        ?>      
                                 <button type="button" onclick="CargarSubContenido('vista/include/formulariodatospersonales')" class="btn btn-success"> <span class="glyphicon glyphicon-chevron-left"></span>   Regresar</button>
                                <button type="button" id="btn" onclick="RegistrarUbicacion('controlador/RegistrarDatosPerUbicacion.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-upload"></span>   Registrar</button> 
                                 
                               
                        <?php
                            }
                        ?>
                    <button type="button" id="btn" onclick="SiguienteUbicacion()" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Siguiente</button> <br>
                    <br>               
                </center>
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
