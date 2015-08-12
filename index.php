<?php

/*
    Document   : index.php
    Created on : 2015-07-21 11:05 am
    Author     : dannyrojas
    Description:
    Purpose of the stylesheet follows.
    To change this template use Tools | Templates.
*/
session_start();
if(!empty($_SESSION['login'])){
    header('location:inicio.php');
}else{
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Emsitel</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="vista/css/style.css">
        <link rel="stylesheet" href="vista/css/bootstrap.css">


        
    </head>
    <body>
       <div id="content" class="col-xs-12  col-sm-offset-4 col-sm-4 col-sm-offset-4" >
           <center>  <img src="vista/img/logo_emsitel.png" class="img-rounded img-responsive" style="height:100px;width:250px;" alt="Responsive image">
           </center>
           <div id="form" class="col-xs-10 col-xs-offset-2 col-sm-9 col-sm-offset-2">
               <div class="row">
                   
               <div id="inicar" class="col-xs-12">
                   <h4>Iniciar Sesión</h4>
               </div><br>
              <form method="post" >
                  <div class="form-group" ><br>
                    <label for="exampleInputEmail1">Usuario</label>
                      <div class="input-group">
                         <input type="name" class="delete form-control delete" name="usuario" id="usuario"  placeholder="Digite su usuario">
                         <div class="input-group-addon"><span class='glyphicon glyphicon-user' aria-hidden='true'></span></div> 
                      </div>
                      <span id="usuario_error" class="error_log"></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                      <div class="input-group">
                            <input type="password" class="delete form-control" name="password" id="password" placeholder="Digite su Clave">
                             <div class="input-group-addon">  <span class="glyphicon glyphicon-lock"></span> </div>
                      </div>
                          <span id="pass_error" class="error_log"></span>
                  </div>
                  
                 <center> 
                     <button type="button"  onclick="Login()"class="ms btn btn-info" style="margin-bottom:15px;"><span class="glyphicon glyphicon-circle-arrow-right"></span>   Iniciar Sesión</button> 
                     <button type="button" onclick="BorrarCampo()" class="ms btn btn-success" style="margin-bottom:15px;"><span class="glyphicon glyphicon-trash"></span>   Borrar Campo</button>
                 <br>
                  </center>
            </form>
           </div>
           
               </div>
         
       </div>
    </body>
    <script type="text/javascript" src="vista/js/jquery.js"></script>
    <script type="text/javascript" src="vista/js/bootstrap.js"></script>
    <script type="text/javascript">
        function Login(){
            var usuario=$('#usuario').val();
            var password=$('#password').val();
            var parametros={'usuario':usuario,'password':password};
            if(usuario.length != 0){
                if(password.length != 0){
                    $.ajax({
                       data:parametros,
                        type:'POST',
                        url:'controlador/loguin.php',
                       
                        success: function(response){
                            if(response == "true"){
                               window.location.replace("inicio.php");
                            }else{
                                document.getElementById('pass_error').innerHTML=("Datos Incorrectos, Verifique y Vuelva A intentarlo");
                                console.log(response);
                            }
                        }
                        
                    });
                }else{
                   document.getElementById('pass_error').innerHTML=("No Puede Estar Este Campo Vacio");
                   
                }
            }else{
                   document.getElementById('usuario_error').innerHTML="No Puede Estar Este Campo Vacio";
                
                }
        }
        
        function BorrarCampo(){
              document.getElementById('usuario').value="";
              document.getElementById('password').value="";
            document.getElementById('pass_error').innerHTML=("");
            document.getElementById('usuario_error').innerHTML="";
        }
    </script>
</html>
<?php
}
    ?>