<?php
/*se hace el include, para poder llamar la clase y a los objetos y funciones que se declaran en ella*/
include ('../../modelo/Datos.php');
/*se inicializa la funcion de session*/
session_start();
/*creo el objeto*/
$datosF = new Datos();
/* si la variable de session datosF es diferente a vacio guardara,se guardaran los datos del variable $_SESSION['datosF'] en la variable $datosF */
/*Esto se hace para cambiar el valor de los metodos creados en la clase Datos que estan vacios, entonces al dar clic en siguiente el formlario a seguir sera
el encargado de recibir estos datos y se guardaran en la variable $datosF->'variable'='lo que recibe' y despues se le asigna el valor a la variable 
 $_SESSION['datosF'] para que esta ya no sea vacia
 
 ir al formulario de nuevo_registro_personal_ubicacion.php para entender mejor
*/
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
/* si el usuario da clic en nuevo registro la variable $_SESSION['datosF'] cera igual a vacio*/
if(!empty($_POST['Nuevoreg'])){
    $_SESSION['datosF']="";
}
?>
<ol class="breadcrumb">
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_personales')">Clientes Personales</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal')">Nuevo Registro</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal')">Datos Personales</a></li>
  
</ol> 
<div id="container">
    <div class="col-xs-12">
                <button type="button" onclick="NuevoRegistroPersonal('vista/include/nuevo_registro_personal')" class="btn btn-success float"><span class="glyphicon glyphicon-plus-sign"></span>  Nuevo Registro</button>
                <br>
                
            </div>
    <div id="row">
        <div id="bn">
            <h2>Registrar Cliente Personal</h2>
            <hr class="hrcolor">
            <!-- se mostraran los campos del formulario-->
            <div id="form-rg-p" class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-7">
            <form method="post" enctype="multipart/form-data" name="formulario1">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Personales</h3>
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-12"><br>
                        <label id="examplePass">Cedula</label>
                        <div class="input-group">
                            <!-- se le da un valor al input con la  variable $datosF->nit;-- la cual al principio estara vacia, pero si se pasa de formulario y se devuelve esta estara hay  -->
                             <input type="number" class="form-control" onkeyup="Cedula('controlador/PresionarCedula.php')" placeholder="Numero de Cedula" name="cedula_persona" id="cedula_persona" value="<?php echo $datosF->cedula; ?>">
                             <div class="input-group-addon"><span id="span_icon" class="glyphicon glyphicon-ok"  ></span></div> 
                         </div><span id="span_cedula"></span><br>
                     </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Primer Nombre</label>
                        <input type="text" class="form-control"  placeholder="Primer Nombre" name="1nombre_persona" id="1nombre_persona" value="<?php echo $datosF->nombre1; ?>">
                    
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Segundo Nombre</label>
                        <input type="text" class="form-control"  placeholder="Segundo Nombre" name="2nombre_persona"id="2nombre_persona" value="<?php echo $datosF->nombre2; ?>">
                    
                    </div>
                </div>
                <div class="col-xs-12">
                    <span id="span_nombre"></span><br>
                    
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Primer Apellido</label>
                        <input type="text" class="form-control"  placeholder="Primer Apellido" name="1apellido_persona" id="1apellido_persona" value="<?php echo $datosF->apellido1; ?>">
                   
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Segundo Apellido</label>
                        <input type="text" class="form-control"  placeholder="Segundo Apellido" name="2apellido_persona" id="2apellido_persona" value="<?php echo $datosF->apellido2; ?>">
                    
                    </div>
                </div>
                <div class="col-xs-12">
                    <span id="span_apellido"></span>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Direccion</label>
                        <input type="text" class="form-control" placeholder="Direccion de vivienda" name="direccion_persona" id="direccion_persona" value="<?php echo $datosF->direccionper; ?>">
                        <span id="span_direccion"></span><br>
                    </div>
                </div>
                
                <div class="form-group">   
                    <div class="col-sm-6 col-xs-12">
                         <label id="examplePass">Municipio</label>
                        <select class="form-control" name="municipio_persona" id="municipio_persona">
                            <option value="0">Seleccione el Municipio</option>
                             <?php
                                $query2=$datosF->BD_Municipios();
                                /*esta funcion se hace para seleccionar la opcion cuando sea igual al valor de la variable datosF*/
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
                </div>
                <input type="hidden" id="selec" value="<?php echo $datosF->municipioper; ?>">
                <script type="text/javascript">
                    
                        var selec=$('#selec').val();
                        document.getElementById('municipio_persona').value=selec;
                        console.log(selec);
                </script>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Telefono</label>
                        <input type="number" class="form-control" placeholder="Numero telefonico" name="telefono_persona" id="telefono_persona" value="<?php echo $datosF->telefonoper; ?>">
                        <span id="span_telefono"></span><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Celular</label>
                        <input type="number" class="form-control" Onkeyup="Celular()"placeholder="Numero Celular" name="celular_persona" id="celular_persona" value="<?php echo $datosF->celularper; ?>">
                        <span id="span_celular"></span><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        
                    
                    <label id="examplePass">Email</label>
                    <input type="email" class="form-control" onkeyup="Email('email_persona')" placeholder="Correo del cliente" name="email_persona" id="email_persona"  value="<?php echo $datosF->emailper; ?>">
                    <span id="span_email"></span><br>
                        </div>
                </div>
                <center>
                    <button type="button" id="btn" onclick="SiguienteDatosPersonales()" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Siguiente</button> <br>
                    <br>               
                </center>
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