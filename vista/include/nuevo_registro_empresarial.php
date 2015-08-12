 <?php
/*se hace el include, para poder llamar la clase, crear el objeto y llamar los metodos que se declaran en ella*/
include ('../../modelo/Datos.php');
/*se inicializa la funcion de session*/
session_start();
/*creo el objeto*/
$datosF = new Datos();
/* si la variable de session datosF es diferente a vacio guardara,se guardaran los datos del variable $_SESSION['datosF'] en la variable $datosF */
/*Esto se hace para cambiar el valor de los metodos creados en la clase Datos que estan vacios, entonces al dar clic en siguiente el formlario a seguir sera
el encargado de recibir estos datos y se guardaran en la variable $datosF->'variable'='lo que recibe' y despues se le asigna el valor a la variable 
 $_SESSION['datosF'] para que esta ya no sea vacia
 
 ir al formulario de formulariodatospersonales.php y a nuevo_registro_personal_ubicacion.php para entender mejor
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
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_empresariales')">Clientes Empresariales</a></li>
    <li><a  id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_empresarial')">Nuevo Registro</a></li>
               
</ol>
<div id="container">
    
    <div id="row">
        <div class="col-xs-12">
                <button type="button" onclick="NuevoRegistroPersonal('vista/include/nuevo_registro_empresarial')" class="btn btn-success float"><span class="glyphicon glyphicon-plus-sign"></span>  Nuevo Registro</button>
                <br>
                
            </div>  
        <div id="bn">
            <h2>Registrar Cliente Empresarial</h2>
            <hr class="hrcolor">
                <div id="form-rg-p" class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-7">
            
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Empresariales</h3>
                    </div>
                </div>
                <!-- Se mostrara el campo para verficar el numero de cedula-->
                
                
                 <div class="form-group"><br>
                    <label id="examplePass">Nit/Cedula</label>
                    <input type="number" class="form-control"  placeholder="Escriba el Nit o numero de cedula" id="nit_empresa" value="<?php echo $datosF->nit;?>">
                        <span id="span_nit"></span>
                </div>
                <div id="verificarc">
                    <center>
                         <!-- Al dar clic se ejecutara la funcion de javascript y esta devolvera un resultado-->
                        <button type="button" onclick="VerificarNit()" class="btn ct"><span class="glyphicon glyphicon-filter"></span>  Verificar</button>
                   
                   </center><br>
               </div>
            
            </div>
            <div id="forms" class="col-md-3">
              
            </div>
            <div id="hid">
                
            </div>
        </div>
        <div id="espa" class="col-xs-12">
                          
                        </div>
    </div>
    
</div>