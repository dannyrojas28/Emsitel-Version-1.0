<?php
/*se inicializa la function de session*/
session_start();
/*se creal la variable de session cliente la cual sera igual a empresarial, lo cual nos hara sabeer que estamos en la sesion de clientes empresariales*/
$_SESSION['cliente']="empresarial";
/*se crea la variable de session datosF vacia la cual se usara mas adelante*/
$_SESSION['datosF']="";
?>
<ol class="breadcrumb">
    
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/reg_clientes_empresariales')">Clientes Empresariales</a></li>
  
</ol>
<div id="row">
    <div id="col-xs-offset-1 col-xs-11">
        <div class="col-sm-12 col-xs-12">
            <div class="col-xs-12">
                 <!-- se mostrara el boton de nuevo registro empresarial en la parte superior derecha de la pantalla -->
                <button type="button" onclick="CargarSubContenido('vista/include/nuevo_registro_empresarial')" class="btn btn-success float"><span class="glyphicon glyphicon-plus-sign"></span>  Nuevo Registro</button>
                <br>
                
            </div>
            <h2>Clientes Empresariales</h2><br>
                <div class="form-group">
                    <label id="examplePass" class="col-xs-3">Filtrar Por :</label>
                    <div class="col-xs-5 ">    
                        <!-- la barra de busqueda en la cual el usuario podra ingresar digitos (numeros-letras) y este mostrara una respuesta -->
                        <input type="text" class="form-control" placeholder="Digite su busqueda" onkeyup="FiltroClientesEmpresariales()" id="palabra" id="busqueda_clientes_personales">
                        <span id="error_pass"  class="error_log"></span>
                    </div>
                    
                  <br>
                    
                </div>
            <hr class="hrcolor">
             <!-- Aqui se mostraran los datos de la consltas hechas -->
                <div id="consultaClientesEmpresariales">
                    
                    
                </div>
                
                
                
        </div>
   </div>
</div>   

<script type="text/javascript">
    //esto se ejecutara automaticamente cuando el usuario ingrese a este archivo, que sera la funcion encargada de mostrar los 25 clientes empresariales
 var parametro={'parama':1};
    $.ajax({
    data:parametro,
     type:"POST",
     url:"controlador/consulta25clientesempresariales.php",
     beforeSend:function(){
        document.getElementById('consultaClientesEmpresariales').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
    },
       success:function(response){
            document.getElementById('consultaClientesEmpresariales').innerHTML=response;
            
       }

    });
     //Al presionar una tecla se ejecuta esta funcion en la barra de busqueda se ejecutara esta funcion
    function FiltroClientesEmpresariales(){
        var palabra=$('#palabra').val();
        //apartir de la 4 tecla presionada se ejecutara la funcion ajax, la cual enviara el parametro por medio de POST al archivo de la variable url y este arrojara una respuesta
        if(palabra.length > 3){
           var parametro={'palabra':palabra};
              //se enviaran los datos al controlador,por medio del metodo POST
            $.ajax({
            data:parametro,
             type:"POST",
             url:"controlador/FiltroClientesEmpresariales.php",
                beforeSend:function(){
                       document.getElementById('consultaClientesEmpresariales').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
                 },
                success:function(response){
                     document.getElementById('consultaClientesEmpresariales').innerHTML=response;
                    
                }

             });
         }
        //si no es mayor de 3 mostrara los mismos 25 clientes
        else{
             var parametro={'parama':1};
                 $.ajax({
                data:parametro,
                 type:"POST",
                 url:"controlador/consulta25clientesempresariales.php",
                 beforeSend:function(){
                    document.getElementById('consultaClientesEmpresariales').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
                },
                   success:function(response){
                        document.getElementById('consultaClientesEmpresariales').innerHTML=response;

                   }

                });
         }
         }
</script>