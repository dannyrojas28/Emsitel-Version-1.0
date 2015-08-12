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
 
 ir al formulario de formulariodatosEmpresariales.php y a nuevo_registro_personal_ubicacion.php para entender mejor
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
            <div id="form-rg-p" class="col-xs-12 col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-7">
           
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Personales</h3>
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-12"><br>
                        
                        <label id="examplePass">Cedula</label>
                            <input type="number" class="form-control"  placeholder="Numero de Cedula" name="cedula_persona" id="cedula_persona" value="<?php echo $datosF->cedula; ?>">
                        <span id="span_cedula"></span><br>
                     </div>
                </div>
                
            
                <div id="verificarc">
                    <center>
                        <button type="button" onclick="VerificarCedula()" class="btn ct"><span class="glyphicon glyphicon-filter"></span>  Verificar</button>
                   
                   </center><br>
               </div>
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