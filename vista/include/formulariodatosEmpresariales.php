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
<input type="hidden" id="BorrarDatos">
<ol class="breadcrumb">
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_empresariales')">Clientes Empresariales</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_empresarial')">Nuevo Registro</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_empresarial')">Datos Empresariales</a></li>
  
</ol> 
<div id="container">
    <div class="col-xs-12">
                <button type="button" onclick="NuevoRegistroPersonal('vista/include/nuevo_registro_empresarial')" class="btn btn-success float"><span class="glyphicon glyphicon-plus-sign"></span>  Nuevo Registro</button>
                <br>
                
            </div>
    <div id="row">
        <div id="bn">
            <h2>Registrar Cliente Empresarial</h2>
            <hr class="hrcolor">
            <!-- se mostraran los campos del formulario-->
            <div id="form-rg-p" class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-7">
            <form method="post" enctype="multipart/form-data" name="formulario1">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Empresariales</h3>
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-12"><br>
                        <label id="examplePass">Nit/Cedula</label>
                         <div class="input-group">
                              <!-- se le da un valor al input con la  variable $datosF->nit;-- la cual al principio estara vacia, pero si se pasa de formulario y se devuelve esta estara hay  -->
                             <input type="number" class="form-control" onkeyup="Cedula('controlador/PresionarNit.php')" placeholder="Nit o Numero de Cedula" name="nit_empresa" id="cedula_persona" value="<?php echo $datosF->nit; ?>">
                                <div class="input-group-addon"><span id="span_icon" class="glyphicon glyphicon-ok"></span></div> 
                         </div>
                        <span id="span_cedula"></span><br>
                     </div>
                </div>
                <div class="form-group">
                    <div class=" col-xs-12">
                        <label id="examplePass"> Nombre/Razon Social Empresa</label>
                         <!-- se le da un valor al input con la  variable $datosF->nombre_emp;-- la cual al principio estara vacia, pero si se pasa de formulario y se devuelve esta estara hay  -->
                        <input type="text" class="form-control"  placeholder="Nombre Empresa" name="nombre_empresa" id="1nombre_persona" value="<?php echo $datosF->nombre_emp; ?>">
                     <span id="span_nombre"></span><br>
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class=" col-xs-12">
                        <label id="examplePass"> Representante Legal</label>
                         <!-- se le da un valor al input con la  variable $datosF->nombre_emp;-- la cual al principio estara vacia, pero si se pasa de formulario y se devuelve esta estara hay  -->
                        <input type="text" class="form-control"  placeholder="Nombre Representante Legal" name="nombre_representane" id="1apellido_persona" value="<?php echo $datosF->nombrerep_emp; ?>">
                     <span id="span_apellido"></span><br>
                    </div>
                    
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Direccion</label>
                         <!-- se le da un valor al input con la  variable $datosF->direccion_emp;-- la cual al principio estara vacia, pero si se pasa de formulario y se devuelve esta estara hay  -->
                        <input type="text" class="form-control" placeholder="Direccion de vivienda" name="direccion_empresa" id="direccion_empresa" value="<?php echo $datosF->direccion_emp; ?>">
                        <span id="span_direccion"></span><br>
                    </div>
                </div>
                <div class="form-group">   
                    <div class="col-sm-6 col-xs-12">
                         <label id="examplePass">Municipio</label>
                         <!-- Imprimo los municpios alojados en el banco de datos  -->
                        <select class="form-control" name="municipio_empresa" id="municipio_persona">
                            <option value="0">Seleccione el Municipio</option>
                             <?php
                                $query2=$datosF->BD_Municipios();
                                while($row=mysqli_fetch_array($query2)){
                                   /*esta funcion se hace para seleccionar la opcion cuando sea igual al valor de la variable datosF*/
                                    if($datosF->municipio_emp == $row['cod_mun']){
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
                        <input type="number" class="form-control" Onkeyup="Celular()" placeholder="Numero Celular" name="celular_persona" id="celular_persona" value="<?php echo $datosF->celularper; ?>">
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
                     <button type="button" id="btn" name="btn" onclick="SiguienteDatosPersonales()" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Siguiente</button> <br>
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