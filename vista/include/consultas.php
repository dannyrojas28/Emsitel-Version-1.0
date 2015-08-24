<?php
/*se inicializa la function de session*/
session_start();
/*se crea la variable de session datosF vacia la cual se usara mas adelante*/
$_SESSION['datosF']="";
?>
<ol class="breadcrumb">
    <!-- se mostraran las secuencias de los pasos ejecutados -->
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/consultas')">Consultas</a></li>
  
</ol>  
<div id="row">
    <div id="col-xs-offset-1 col-xs-11">
        <div class="col-sm-12 col-xs-12">
            
            <h4>Realiza tu busqueda por clientes personales o empresariales</h4><br>
          
                
            
                <div class="form-group">
                    <label id="examplePass" class="col-xs-2">Filtrar Por:</label>
                    <div class="col-xs-5 ">    
                        <!-- la barra de busqueda en la cual el usuario podra ingresar digitos (numeros-letras) y este mostrara una respuesta -->
                        <input type="text" class="form-control" placeholder="Digite su busqueda" onkeyup="FiltroClientes()" id="palabra">
                        <span id="error_pass"  class="error_log"></span>
                    </div>
                    
                  <br>
                    
                </div>
              
           
            <hr class="hrcolor">
            <!-- Aqui se mostraran los datos de la consltas hechas -->
            <div id="consultaClientes">
            </div>
                
                   
                
            
            
           
        </div>
        
    </div>   
     
</div>
<script type="text/javascript">
    //esto se ejecutara automaticamente cuando el usuario ingrese a este archivo, que sera la encargada de mostrar los 25 primeros clientes 
 var parametro={'parama':1};
    $.ajax({
    data:parametro,
     type:"POST",
     url:"controlador/consultas.php",
     beforeSend:function(){
        document.getElementById('consultaClientes').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
    },
       success:function(response){
            document.getElementById('consultaClientes').innerHTML=response;
            
       }

    });
    //Al presionar una tecla se ejecuta esta funcion en la barra de busqueda se ejecutara esta funcion
    function FiltroClientes(){
        var palabra=$('#palabra').val();
        //apartir de la 4 tecla presionada se ejecutara la funcion ajax, la cual enviara el parametro por medio de POST al archivo de la variable url y este arrojara una respuesta
        if(palabra.length > 3){
                    var parametro={'palabra':palabra};
            $.ajax({
               //se enviaran los datos al controlador,por medio del metodo POST
            data:parametro,
             type:"POST",
             url:"controlador/FiltroClientes.php",
                beforeSend:function(){
                       document.getElementById('consultaClientes').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
                 },
                success:function(response){
                    var print=response.split('+');
                    if(print[0] == "true"){
                     document.getElementById('consultaClientes').innerHTML=print[1];
                    }else{
                        document.getElementById('consultaClientes').innerHTML=response;
                    }
                }

             });
         }
        //si no es mayor de 3 mostrara los mismos 25 clientes
        else{
             
             var parametro={'parama':1};
                $.ajax({
                data:parametro,
                 type:"POST",
                 url:"controlador/consultas.php",
                 beforeSend:function(){
                    document.getElementById('consultaClientes').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
                },
                   success:function(response){
                        document.getElementById('consultaClientes').innerHTML=response;

                   }

                });
         }
         }
         
</script>