 <?php
/*
    Document   : inicio.php
    Created on : 2015-07-21 11:10 am
    Author     : dannyrojas
    Description:
    Purpose of the stylesheet follows.
    To change this template use Tools | Templates.
*/
session_start();
if(empty($_SESSION['login'])){
    header('location:index.php');
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
        <div id="precarga" style="width:100%;height:100%;">
            
            <div style="margin-top:20%;">
                <center>
                    <img src="vista/img/load.gif" style="width:50px;height:50px;">
                    <h1 style="color:green;">  Cargando.....</h1></center>
                
            </div>
        </div>
        <div id="container" class="container" style="visibility:hidden">
            <div >
<nav id="head" class="navbar navbar-default">
                  <div class="row">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="col-sm-12 col-xs-12 col-md-3">
                        
                        <div class="navbar-header ">
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>
                            <div class="visible-md visible-lg" >
                                 <img src="vista/img/logo_soportel.png" class="navbar-brand" style="width:230px;height:100px;">
                            </div>
                               <div class="visible-sm visible-xs" >
                                 <img src="vista/img/logo_soportel.png" class="navbar-brand" style="width:170px;height:100px;">
                            </div>
                        </div>
                     </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="col-sm-12 col-xs-12  col-md-9">
                         
                    
                        <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav navbar-right">
                                <ul class="nav nav-tabs nav-justified hidden-xs">
                                   
                                        
                                    <?php if($_SESSION['rol'] != 3){
                                     ?>
                                  <li ><a onclick="CargarSubContenido('vista/include/registros')" id="cursor" >Registros</a></li>
                                  <li ><a onclick="CargarSubContenido('vista/include/consultas')" id="cursor"  >Consultas</a></li>
                                  <li ><a onclick="CargarSubContenido('vista/include/informes')" id="cursor" >Informes</a></li>  
                                  <li ><a onclick="CargarSubContenido('vista/include/bancodatos')" id="cursor" >Banco de Datos</a></li>
                                 <?php }else{
                                    echo ' <li ><a onclick="CargarSubContenido(\'controlador/ServiciosTecnicos\')" id="cursor" ><span class="glyphicon glyphicon-lock"></span>  Mis Servicios</a></li>';
                                } 
                                    
                                    
                                    ?>   
                              </ul>
                          
                                    <ul class="nav nav-tabs  visible-xs">
                                          <?php if($_SESSION['rol'] != 3){
                                     ?>
                                      <li role="presentation" class="df"><a onclick="CargarSubContenido('vista/include/home')" id="cursor">Inicio</a></li>
                                      <li role="presentation" class="df"><a onclick="CargarSubContenido('vista/include/registros')" id="cursor">Registros</a></li>
                                      <li role="presentation" class="df"><a onclick="CargarSubContenido('vista/include/consultas')" id="cursor" >Consultas</a></li>
                                      <li role="presentation" class="df"><a onclick="CargarSubContenido('vista/include/informes')" id="cursor" >Informes</a></li>  
                                      <li role="presentation" class="df"><a onclick="CargarSubContenido('vista/include/bancodatos')" id="cursor" >Banco de Datos</a></li>
                                       
                                         <?php
                                              if($_SESSION['rol'] == 1){
                                            ?>
                                             <li role="presentation" class="df"><a  id="cursor" onclick="CargarSubContenido('vista/include/config')"><span class="glyphicon glyphicon-cog"></span>  Configuracion</a></li><br>
                                            <?php
                                              }
                                            }else{
                                               echo  ' <li role="presentation" class="df"> <a  id="cursor" onclick="CargarSubContenido(\'controlador/ServiciosTecnicos\')"><span class="glyphicon glyphicon-lock"></span>  Mis Servicios</a></li><br>';
                                            }
                                            ?>
                                         <hr class="hrcolor df">
                                        <li role="presentation" class="df"> <a  id="cursor" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-off"></span>  Cerrar Sesion</a></li><br>
                                      
                                    </ul>
                              </ul>

                      
                        </div><!-- /.navbar-collapse -->
                     </div>
                  </div><!-- /.container-fluid -->
                </nav>
        </div>
            <div id="body" class="col-xs-12">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12  col-sm-3 col-md-3 col-lg-2 sm">
                            <div id="bn"></div>
                            <a class="list-group-item list-group-item-success hidden-xs" id="cursor" onclick="CargarSubContenido('vista/include/home')"><span class="glyphicon glyphicon-th"></span>  Inicio</a>
                            
                            <a class="list-group-item list-group-item-success hidden-xs" id="cursor" onclick="CargarSubContenido('vista/include/config')"><span class="glyphicon glyphicon-cog"></span>  Configuracion</a>
                           
                            <a class="list-group-item list-group-item-success hidden-xs"id="cursor" data-toggle="modal" data-target=".bs-example-modal-sm"><span class="glyphicon glyphicon-off"></span>  Cerrar Sesion</a><br>
                           <div class="visible-xs col-xs-6">
                               <center><img src="vista/img/<?php  echo $_SESSION['imagen'];?>" class="img-thumbnail img-responsive" style="height:140px;width:140px;" alt="Responsive image"></center>
                            
                            </div>
                            <div class="visible-sm visible-md visible-lg hidden-xs">
                                <center><img src="vista/img/<?php  echo $_SESSION['imagen'];?>" class="img-thumbnail img-responsive" style="height:140px;width:140px;" alt="Responsive image"></center>
                            
                            </div>
                            <div class="visible-xs col-xs-6">
                              <p class="list-group-item list-group-item-success"  ><span class="glyphicon glyphicon-wrench"></span>    <?php  echo $_SESSION['nombres'];?></p><br>
                                
                            </div>
                            <div class="visible-sm visible-md visible-lg hidden-xs">
                                <p class="list-group-item list-group-item-success"  ><span class="glyphicon glyphicon-wrench"></span>  <?php  echo $_SESSION['nombres'];?></p><br>
                        
                            </div>
                        </div>
                        
                        <div id="contenido" class=" col-sm-9 col xs-12 col-md-9 col-lg-10">
                                  <div class="row">
                                        <div id="subcontent" class="col-xs-12">
                                         <div class="col-xs-12  col-sm-offset-1 col-sm-10 col-sm-offset-1">
                                            <div id="carousel-example-generic" class="carousel slide ft" data-ride="carousel">
                                              <!-- Indicators -->
                                              <ol class="carousel-indicators">
                                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                              </ol>

                                              <!-- Wrapper for slides -->
                                              <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                  <img src="vista/img/ns1.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                                <div class="item">
                                                  <img src="vista/img/ns2.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                                  <div class="item">
                                                  <img src="vista/img/ns3.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                                  <div class="item">
                                                  <img src="vista/img/ns4.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                                  <div class="item">
                                                  <img src="vista/img/ns5.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                                  <div class="item">
                                                  <img src="vista/img/ns6.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                                  <div class="item">
                                                  <img src="vista/img/ns7.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                                  <div class="item">
                                                  <img src="vista/img/ns9.png"  >
                                                  <div class="carousel-caption">

                                                  </div>
                                                </div>
                                             </div>

                                              <!-- Controls -->
                                              <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                              </a>
                                              <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                              </a>
                                            </div>
                                            <br>

                                         </div>

                                        </div>
                                  </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
              <div id="php">
                
              </div>

            <div id="footer" class="col-xs-12">
                <center> <p>Derechos Reservados © <a href="mailto:rojas2895@gmail.com">Danny Rojas</a>-2015</p><br> </center>
            </div>
        </div>
        
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">¿Estas Seguro en concluir la sesion?</h4>
            </div>
            <div class="modal-body" id="bod">
                <button type="button" onclick="Destroy()" class="btn btn-primary">Si, estoy Seguro</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              </div>
          </div>
        </div>
      </div>
   </div>
        <a class="hidden" id="modalls" data-toggle="modal" data-target=".bs-example-modal-lg"></a><br>
     <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" id="lp">
        <div class="modal-content">
          <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <center><h4 class="modal-title" id="tx"></h4></center>
            </div>
              <center><div class="modal-body" id="bd">
                    
                  </div></center>
          </div>
        </div>
      </div>
   </div>
                           
   </body>
    
   
<script type="text/javascript" src="vista/js/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">

    /*Esta funcion permite cerrar la sesion*/
    /**/
    /**/
function Destroy(){
    var url = "controlador/cerrarsesion.php"; 
   $(location).attr('href',url);
 }
    
    /*Esta funcion permite cargar los contenidos a mostrar*/
    /**/
    /**/
    function CargarSubContenido(argument){
         $.get(argument+".php").done(
            function(data){
                $(dom('subcontent')).html(data);
            });
    }

    function dom(argument){
        return document.getElementById(argument);
    } 

    /*en esta parte se realizaran todas las funciones necesarias para el registro de clientes personales*/
    /**/
    /**/
    /**/
    /**/
    /**/
    /*Cada Funcion Tendra Un Nombre,en el cual se reflejara la accion a realizar*/
    /**/
    /**/
    /*Esta funcion Preguntara por campos vacios y despues pasara al siguinte formulario*/
    function SiguienteDatosPersonales(){
        var formData= new FormData(document.forms.namedItem("formulario1"));
        var cedula=$("#cedula_persona").val();
        var Nombre=$("#1nombre_persona").val();
        var apellido=$("#1apellido_persona").val();
        var email=$("#email_persona").val();
        var mun=$("#municipio_persona").val();
        if(cedula.length > 0){
            document.getElementById("span_cedula").innerHTML="";
            if(Nombre.length > 0){
                document.getElementById("span_nombre").innerHTML="";
                if(apellido.length >0){
                    document.getElementById("span_apellido").innerHTML="";
                    if(mun !=0){
                      if(email.length > 0){
                        var expre=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if(expre.test(email)){
                            document.getElementById('span_email').innerHTML="";

                            $.ajax({
                                data:formData,
                                type:"POST",
                                url:"vista/include/nuevo_registro_personal_ubicacion.php",
                                cache: false,
                                contentType: false,
                                processData: false,

                                success:function(response){
                                   var argument="vista/include/nuevo_registro_personal_ubicacion";
                                   $.get(argument+".php").done(
                                    function(data){
                                        $(dom('subcontent')).html(data);
                                    });
                                }
                            });
                        }
                      
                        else{
                            document.getElementById('span_email').innerHTML="<font color='red'>Direccion de correo Invalida</font>";
                        }
                    }else{
                      document.getElementById('span_email').innerHTML="";

                            $.ajax({
                                data:formData,
                                type:"POST",
                                url:"vista/include/nuevo_registro_personal_ubicacion.php",
                                cache: false,
                                contentType: false,
                                processData: false,

                                success:function(response){
                                   var argument="vista/include/nuevo_registro_personal_ubicacion";
                                   $.get(argument+".php").done(
                                    function(data){
                                        $(dom('subcontent')).html(data);
                                    });
                                }
                            });
                    }
                    }else{

                      document.getElementById('span_municipioper').innerHTML="<font color='red'>Seleccione un Municipio</font>";
                    }
                }else{
                    document.getElementById("span_apellido").innerHTML="<font color='red'>No puede estar Vacio</font>";
                    $("#cedula_persona").addClass("error");
                }
            }else{
                document.getElementById("span_nombre").innerHTML="<font color='red'>Digita almenos  Nombre</font>";
                $("#cedula_persona").addClass("error");
            }
        }else{
            document.getElementById("span_cedula").innerHTML="<font color='red'>Digita un numero Valido</font>";
            $("#cedula_persona").addClass("error");
        }
    }
    /*Esta Funcion Preguntara Si ya existe un numero de contrato en la base de datos igual  al digitado en el formulario */
    /**/
    /**/
    /**/
    /*Esta funcion Preguntara por campos vacios y despues pasara al siguinte formulario*/
    /**/
    /**/
    
    function SiguienteUbicacion(){
        var formData= new FormData(document.forms.namedItem("formulario2"));
        var nom_ubicacion=$("#nombre_ubicacion").val();
        var dir_ubicacion=$("#direccion_ubicacion").val();
        var mun_ubicacion=$("#municipio_ubicacion").val();
        var email_ubi=$("#email_per_ubicacion").val();
        
        if(nom_ubicacion.length > 0){
            document.getElementById("span_nombre").innerHTML="";
            if(dir_ubicacion.length > 0){
                document.getElementById("span_direccion").innerHTML="";
                if(mun_ubicacion != 0){
                    document.getElementById("span_municipio").innerHTML="";
                    if(email_ubi.length > 0){
                      var expre=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                      if(expre.test(email_ubi)){
                        document.getElementById('span_email').innerHTML="";
                        $.ajax({
                             data:formData,
                            type:"POST",
                            url:"vista/include/nuevo_registro_personal_servicio.php",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(response){
                                 var argument="vista/include/nuevo_registro_personal_servicio";
                               $.get(argument+".php").done(
                                function(data){
                                    $(dom('subcontent')).html(data);
                                });
                            }

                        });
                        }else{
                            document.getElementById('span_email').innerHTML="<font color='red'>Direccion de correo Invalida</font>";
                       
                        }
                  }else{
                     document.getElementById('span_email').innerHTML="";
                        $.ajax({
                             data:formData,
                            type:"POST",
                            url:"vista/include/nuevo_registro_personal_servicio.php",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success:function(response){
                                 var argument="vista/include/nuevo_registro_personal_servicio";
                               $.get(argument+".php").done(
                                function(data){
                                    $(dom('subcontent')).html(data);
                                });
                            }

                        });
                  }
                }else{
                    document.getElementById("span_municipio").innerHTML="<font color='red'>Seleccione un Municipio</font>";  
                }
            }else{
                document.getElementById("span_direccion").innerHTML="<font color='red'>Digita direccion valida</font>";
            }
        }else{
            document.getElementById("span_nombre").innerHTML="<font color='red'>Digita un nombre de Ubicacion</font>";
        }
    }
    /**/
    /*Esta funcion Preguntara por campos vacios y despues pasara al siguinte formulario*/
    /**/
    /**/
    function SiguienteServicio(){
        var tiposervicio=$('#tiposervicio').val();
        var estadoservicio=$('#estadoservicio').val();
        var formato_contrato=$('#formato_contrato').val();
        var num_contrato=$('#num_contrato').val();
        var fecha_inicio=$('#fecha_inicio').val();
        var fecha_fin=$('#fecha_fin').val();
        var asesorcomercial=$('#asesorcomercial').val();
         var formData= new FormData(document.forms.namedItem("formulario3"));
        if(tiposervicio != 0){
            document.getElementById('span_tipo').innerHTML="";
            if(estadoservicio != 0){
                document.getElementById('span_estado').innerHTML="";
                if(formato_contrato != 0){
                    document.getElementById('span_formato').innerHTML="";
                    if(num_contrato.length > 0){
                        document.getElementById('span_num').innerHTML="";
                        if(fecha_inicio.length > 0){
                            document.getElementById('span_fechai').innerHTML="";
                            if(fecha_fin.length > 0){
                                document.getElementById('span_fechaf').innerHTML="";
                                if(asesorcomercial != 0){
                                    document.getElementById('span_asesor').innerHTML="";
                                    $.ajax({
                                       data:formData,
                                       type:"POST",
                                        url:"vista/include/nuevo_registro_personal_detalles.php",
                                        cache: false,
                                        contentType: false,
                                        processData: false,
                                        
                                        success:function(){
                                             var argument="vista/include/nuevo_registro_personal_detalles";
                                           $.get(argument+".php").done(
                                            function(data){
                                                $(dom('subcontent')).html(data);
                                            });
                                         }

                                    });
                                    var aumentaipb=2;aumentaipc=2; var aumentaipeq=2;
                                    
                                }else{
                                   document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>"        
                                }
                            }else{
                                document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>"
                            }
                        }else{
                            document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>"
                        }
                    }else{
                        document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>"
                    }
                
                    
                }else{
                    document.getElementById('span_formato').innerHTML="<font color='red'>Seleccione un Formato</font>";
                }
            }else{
                document.getElementById('span_estado').innerHTML="<font color='red'>Seleccione un Estado</font>";
            }
        }else{
            document.getElementById('span_tipo').innerHTML="<font color='red'>Seleccione un tipo</font>";
        }
    }
    /**/
    /*Esta funcion  al dar click en el checkbox del ultimo formulario de registros personales, guardara los datos para poder regresar a los formularios anteriores*/
    function Verificar(){
      var tipoconex=$('#tipoconexion').val();
      var equipos=$('#equipo').val();
      var formData= new FormData(document.forms.namedItem("formulario4"));
      if(tipoconex != 0){
         document.getElementById('span_tipoconex').innerHTML="";
        if(equipos != 0){
          document.getElementById('span_equipo').innerHTML="";
          $.ajax({
            data:formData,
            type:'POST',
           url:"vista/include/nuevo_registro_personal_detalles.php",
           cache: false,
            contentType: false,
            processData: false,
             success:function(response){

                              var aumentaipb=2;aumentaipc=2; var aumentaipeq=2;
                var argument="vista/include/nuevo_registro_personal_detalles";
                               $.get(argument+".php").done(
                                function(data){
                                    $(dom('subcontent')).html(data);
                                });
               }
        });
        }else{
          document.getElementById('span_equipo').innerHTML="<font color='red'>Seleccione un Equipo</font>";
          document.getElementById('equipo').focus();
        }

      }else{
        document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
        document.getElementById('tipoconexion').focus();
              }
    }

    /*Esta funcion Insertara los datos de todos los formularios digitados de clientes personales*/
    /**/
    /**/
    function RegistrarClientes(argument){
      var tipoconex=$('#tipoconexion').val();
      var nodo=$('#nodo').val();
      var antena=$('#antena').val();
      var formData= new FormData(document.forms.namedItem("formulario4"));
      if(tipoconex != 0){
         document.getElementById('span_tipoconex').innerHTML="";
        if(nodo != 0){
          document.getElementById('span_nodo').innerHTML="";
          if(antena != 0){
          document.getElementById('span_antena').innerHTML="";
            $.ajax({
            data:formData,
            type:'POST',
           url:argument,
           cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(){ 
                $('#lp').removeClass();
              $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'><img src='vista/img/load.gif' style='width:70px;height:50px;'>   Registrando,espera un momento!</font>";
                                    document.getElementById('bd').innerHTML="";
                                  
                                    $("#modalls").click();
                                },
                            success:function(response){
                                 var print=response.split('+');
                                 
                                  document.getElementById('bd').innerHTML=print[2];
                                  document.getElementById('tx').innerHTML=print[1];
                               
                            }
            });
          }else{
                document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
          document.getElementById('antena').focus();
          }
        }else{
          document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
          document.getElementById('nodo').focus();
        }

       }else{
        document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
        document.getElementById('tipoconexion').focus();
              }
         
        
    }
    /*Esta funcion Borrara los datos de los campos del formulario de datos personales*/
    /**/
    /**/
    function BorrarDatosPersonales(){
      var BorrarDatos=1;
      var parametro={'BorrarDatos':BorrarDatos};
      $.ajax({
        data:parametro,
        type:"POST",
        url:'vista/include/formulariodatospersonales.php',
        success:function(response){
          document.getElementById('subcontent').innerHTML=response;
        }
      });
    }
    /*Esta funcion Borrara los datos de los campos del formulario de Ubicaciones personales*/
    /**/
    /**/
    function BorrarUbicacionesPersonales(){
      var BorrarDatos2=1;
      var parametro={'BorrarDatos2':BorrarDatos2};
      $.ajax({
        data:parametro,
        type:"POST",
        url:'vista/include/nuevo_registro_personal_ubicacion.php',
        success:function(response){
          document.getElementById('subcontent').innerHTML=response;
        }
      });
    }
    /*Esta funcion Borrara los datos de los campos del formulario de Ubicaciones personales, el cual se podra ver cuando el usuario ya existe y solo desea agregar nueva ubicacion*/
    /**/
    /**/
    function BorrarCamposU2(){
      document.getElementById('nombre_ubicacion').value="";
      document.getElementById('direccion_ubicacion').value="";
      document.getElementById('municipio_ubicacion').value=0;
      document.getElementById('nombre_per_ubicacion').value="";
      document.getElementById('apellido_per_ubicacion').value="";
      document.getElementById('telefono_per_ubicacion').value="";
      document.getElementById('email_per_ubicacion').value="";
      document.getElementById('celular_per_ubicacion').value="";
    }
    /*Esta funcion Mostrara el formulario de Servicios personales, el cual se podra ver cuando el usuario ya existe y solo desea agregar nueva ubicacion*/
    /**/
    /**/
    function NuevoRegistroPersonal(argument){
      var Nuevoreg=1;
      var parametro={'Nuevoreg':Nuevoreg};
      $.ajax({
        data:parametro,
        type:"POST",
        url:argument+".php",
        success:function(response){
           $.get(argument+".php").done(
           function(data){
             $(dom('subcontent')).html(data);
        });
        }
      });
    }
    
    function VerificarCedula(){
      var cedula=$('#cedula_persona').val();
      var parametro={'cedula':cedula};
      if(cedula.length > 0){
         document.getElementById('span_cedula').innerHTML="";
         $.ajax({
           data:parametro,
           type:"POST",
           url:"controlador/verificarcedula.php",
            success:function(response){
              var prin=response;
              var arreglo=prin.split("+");
              if(arreglo[0] != "false"){
                document.getElementById('span_cedula').innerHTML="<font color='blue'>Este Usuario ya existe</font>";
                document.getElementById('verificarc').innerHTML=arreglo[1];
              }else{
                document.getElementById('span_cedula').innerHTML="";
                     var argument="vista/include/formulariodatospersonales";

                               $.get(argument+".php").done(
                                function(data){
                                    $(dom('subcontent')).html(data);
                                });
              }
              
            }
         })
      }else{
        document.getElementById('span_cedula').innerHTML="<font color='red'>Digite un numero De Cedula</font>"
      }
    }
    function VerServiciosPer(argument){
    aumentaipb=2;
    aumentaipc=2; 
    aumentaipeq=2;
    console.log(aumentaipeq,aumentaipc,aumentaipb);
      var value_ubi=$('#valueubi').val();
      var cod_ubicacion="";
      var tr=0;
      var compara="false";
      if(value_ubi != 1){
        for( var j=0;j < value_ubi;j++){
             if(document.miFormulario.mychk[j].checked){
              cod_ubicacion =document.miFormulario.mychk[j].value;
              console.log(cod_ubicacion);
              tr=tr+1;
              compara="true";
           }
        }
      }else{
        if(document.miFormulario.mychk.checked){
              cod_ubicacion =document.miFormulario.mychk.value;
              console.log(cod_ubicacion);
              tr=tr+1;
              compara="true";
          }
      }
      if(compara == "true"){
          if(tr == 1){
            document.getElementById('span_ubicacion').innerHTML="";
            var parametro={'cod_ubicacion':cod_ubicacion};
            $.ajax({
              data:parametro,
              type:"POST",
              url:argument,
              success:function(response){
                  $.get(argument).done(
                        function(data){
                         $(dom('verificarSer')).html(data);
                        });
                
              }
            });
          }else{
            document.getElementById('span_ubicacion').innerHTML="<font color='red'>Seleccione solo una Ubicacion</font>"
          }
      }else{
         document.getElementById('span_ubicacion').innerHTML="<font color='red'>Seleccione una Ubicacion para seguir</font>";
      }
    }
    function NuevaUbicacionPersonal(){
      var argument="vista/include/formulariodatospersonalesubicacion";
        $.get(argument+".php").done(
        function(data){
         $(dom('verificarc')).html(data);
        });
    }
    function validateIp(id_ip,descripcion)
{
    //Creamos un objeto
    object=document.getElementsByName(id_ip)[0].value;
    valueForm=object.length;
    
        // Validamos si los números no son superiores al valor 255
    if(valueForm == 3){
        if(object <= 255)
        {
            //Ip correcta
           
            document.getElementsByName('btn')[0].disabled=false;
           document.getElementsByName(id_ip)[0].style.color="#000";
            return;
        }
    }
    //Ip incorrecta
  
      if(valueForm == 3){
          document.getElementById('btn').focus();
           document.getElementsByName('btn')[0].disabled=true;
            document.getElementsByName(id_ip)[0].style.color="#f00";
           $('#lp').removeClass();
           $('#lp').addClass('modal-dialog modal-sm');
           document.getElementById('bd').innerHTML='<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
            document.getElementById('tx').innerHTML=' <div class="alert alert-danger">la direecion ip es mayor a 255</div>';
            $("#modalls").click();
      }
  
    
}
    function NuevoServicioPersonal(){
        var nom_ubicacion=$("#nombre_ubicacion").val();
        var dir_ubicacion=$("#direccion_ubicacion").val();
        var mun_ubicacion=$("#municipio_ubicacion").val();
        var email_ubi=$("#email_per_ubicacion").val();
        
        if(nom_ubicacion.length > 0){
            document.getElementById("span_nombre").innerHTML="";
            if(dir_ubicacion.length > 0){
                document.getElementById("span_direccion").innerHTML="";
                if(mun_ubicacion != 0){
                    document.getElementById("span_municipio").innerHTML="";
                      if(email_ubi.length > 0){
                          var expre=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                          if(expre.test(email_ubi)){
                              document.getElementById('span_email').innerHTML="";
                               var argument="vista/include/formulariodatospersonaleservicio";
                                  $.get(argument+".php").done(
                                  function(data){
                                   $(dom('servi')).html(data);
                                  });

                          }
                          else{
                              document.getElementById('span_email').innerHTML="<font color='red'>Direccion de correo Invalida</font>";
                              
                          }
                    }else{
                      document.getElementById('span_email').innerHTML="";
                               var argument="vista/include/formulariodatospersonaleservicio";
                              $.get(argument+".php").done(
                              function(data){
                               $(dom('servi')).html(data);
                              });

                    }
                }else{
                    document.getElementById("span_municipio").innerHTML="<font color='red'>Seleccione un Municipio</font>";  
                }
            }else{
                document.getElementById("span_direccion").innerHTML="<font color='red'>Digita direccion valida</font>";
            }
        }else{
            document.getElementById("span_nombre").innerHTML="<font color='red'>Digita un nombre de Ubicacion</font>";
            document.getElementById("span_direccion").innerHTML="<font color='red'>Digita direccion valida</font>";
            document.getElementById("span_municipio").innerHTML="<font color='red'>Seleccione un Municipio</font>";  
 
        } 
      
    } function cerrarForm(){
      aumentaipb=2;
    aumentaipc=2; 
    aumentaipeq=2;
    console.log(aumentaipeq,aumentaipc,aumentaipb);
       document.getElementById('servi').innerHTML="";
      document.getElementById('clf').innerHTML='<div id="servi"><center><br> <button type="button" onclick="BorrarCamposU2()" class="btn btn-warning"> <span class="glyphicon glyphicon-trash"></span>  Borrar Campos</button>  <button type="button" onclick="NuevoServicioPersonal()" class="btn btn-success"> <span class="glyphicon glyphicon-plus-sign"></span>  Añadir Servicio</button> <button type="button" onclick="RegistrarUbicacion()" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>  Registrar</button> <br><br>  </center></div>';
   
    }
    function NuevoServicioPersonal2(){
    aumentaipb=2;
    aumentaipc=2; 
    aumentaipeq=2;
   console.log(aumentaipeq,aumentaipc,aumentaipb);
    var argument="vista/include/formulariodatospersonaleservicio2";
       $.get(argument+".php").done(
        function(data){
        $(dom('servi')).html(data);
        });
    
    }
    function RegistrarDatosUbicacionPer(argument){
        var formData= new FormData(document.forms.namedItem("formulario2"));
        var nom_ubicacion=$("#nombre_ubicacion").val();
        var dir_ubicacion=$("#direccion_ubicacion").val();
        var mun_ubicacion=$("#municipio_ubicacion").val();
        var email_ubi=$("#email_per_ubicacion").val();
        
        if(nom_ubicacion.length > 0){
            document.getElementById("span_nombre").innerHTML="";
            if(dir_ubicacion.length > 0){
                document.getElementById("span_direccion").innerHTML="";
                if(mun_ubicacion != 0){
                    document.getElementById("span_municipio").innerHTML="";
                    if(email_ubi.length > 0){
                      var expre=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                      if(expre.test(email_ubi)){
                        document.getElementById('span_email').innerHTML="";
                        $.ajax({
                             data:formData,
                            type:"POST",
                            url:argument,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend:function(){
                                 $('#lp').removeClass();
                                  $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'><img src='vista/img/load.gif' style='width:70px;height:50px;'>  </font>   Registrando,espera un momento!";
                                    document.getElementById('bd').innerHTML="";
                                  
                                    $("#modalls").click();
                                },
                            success:function(response){
                                 var print=response.split('+');
                                 if(print[0] == "true"){
                                  document.getElementById('bd').innerHTML='<button type="button" onclick="CargarSubContenido('+'vista/include/nuevo_registro_personal'+')" class="btn btn-primary ac" data-dismiss="modal"><span class="glyphicon glyphicon-chevron-left"></span>  Verificar</button>';
                                  document.getElementById('tx').innerHTML=print[1];
                               }else{
                                   document.getElementById('bd').innerHTML='<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
                                   document.getElementById('tx').innerHTML=print[1];
                                  
                                }
                            }

                        });
                        }else{
                            document.getElementById('span_email').innerHTML="<font color='red'>Direccion de correo Invalida</font>";
                       
                        }
                  }else{
                     document.getElementById('span_email').innerHTML="";
                        $.ajax({
                             data:formData,
                            type:"POST",
                            url:argument,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend:function(){
                                 $('#lp').removeClass();
                                 $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>   </font>    Registrando,espera un momento!";
                                    document.getElementById('bd').innerHTML="";
                                  
                                    $("#modalls").click();
                                },
                            success:function(response){
                                 var print=response.split('+');
                                 if(print[0] == "true"){
                                  document.getElementById('bd').innerHTML=print[2];
                                  document.getElementById('tx').innerHTML=print[1];
                               }else{
                                   document.getElementById('bd').innerHTML='<button type="button"  class="btn btn-primary ac" data-dismiss="modal">  aceptar</button>';
                                   document.getElementById('tx').innerHTML=print[1];
                                }
                            }

                        });
                  }
                }else{
                    document.getElementById("span_municipio").innerHTML="<font color='red'>Seleccione un Municipio</font>";  
                }
            }else{
                document.getElementById("span_direccion").innerHTML="<font color='red'>Digita direccion valida</font>";
            }
        }else{
            document.getElementById("span_nombre").innerHTML="<font color='red'>Digita un nombre de Ubicacion</font>";
        }
    }
    function RegistrarUbicacion(argument){
     var formData= new FormData(document.forms.namedItem("formulario2"));
        var nom_ubicacion=$("#nombre_ubicacion").val();
        var dir_ubicacion=$("#direccion_ubicacion").val();
        var mun_ubicacion=$("#municipio_ubicacion").val();
        var email_ubi=$("#email_per_ubicacion").val();
        
        if(nom_ubicacion.length > 0){
            document.getElementById("span_nombre").innerHTML="";
            if(dir_ubicacion.length > 0){
                document.getElementById("span_direccion").innerHTML="";
                if(mun_ubicacion != 0){
                    document.getElementById("span_municipio").innerHTML="";
                      if(email_ubi.length > 0){
                          var expre=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                          if(expre.test(email_ubi)){
                              document.getElementById('span_email').innerHTML="";
                              $.ajax({
                                   data:formData,
                                  type:"POST",
                                  url:argument,
                                  cache: false,
                                  contentType: false,
                                  processData: false,
                                   beforeSend:function(){
                                        $('#lp').removeClass();
                                         $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>   </font>    Espera un momento,esto no tarda!";
                                      document.getElementById('bd').innerHTML="";
                                         $("#modalls").click();
                                      },
                                     success:function(response){
                                        var print=response.split('+');
                                       document.getElementById('bd').innerHTML=print[2];
                                        document.getElementById('tx').innerHTML=print[1];
                                    }

                              });
                          }
                          else{
                              document.getElementById('span_email').innerHTML="<font color='red'>Direccion de correo Invalida</font>";
                              
                          }
                    }else{
                      document.getElementById('span_email').innerHTML="";
                              $.ajax({
                                  data:formData,
                                  type:"POST",
                                  url:argument,
                                  cache:false,
                                  contentType:false,
                                  processData:false,
                                  beforeSend:function(){
                                    document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>   </font>    Espera un momento,esto no tarda!";
                                      document.getElementById('bd').innerHTML="";
                                         $("#modalls").click();
                                      },
                                     success:function(response){
                                        var print=response.split('+');
                                       document.getElementById('bd').innerHTML=print[2];
                                        document.getElementById('tx').innerHTML=print[1];
                                    }

                              });
                    }
                }else{
                    document.getElementById("span_municipio").innerHTML="<font color='red'>Seleccione un Municipio</font>";  
                }
            }else{
                document.getElementById("span_direccion").innerHTML="<font color='red'>Digita direccion valida</font>";
            }
        }else{
            document.getElementById("span_nombre").innerHTML="<font color='red'>Digita un nombre de Ubicacion</font>";
        } 
    }
    function RegistrarCliPerServicioUbicacion(argument){
       var tiposervicio=$('#tiposervicio').val();
        var estadoservicio=$('#estadoservicio').val();
        var formato_contrato=$('#formato_contrato').val();
        var num_contrato=$('#num_contrato').val();
        var fecha_inicio=$('#fecha_inicio').val();
        var fecha_fin=$('#fecha_fin').val();
        var asesorcomercial=$('#asesorcomercial').val();
        var formData= new FormData(document.forms.namedItem("formulario2"));
        if(tiposervicio != 0){
            document.getElementById('span_tipo').innerHTML="";
            if(estadoservicio != 0){
                document.getElementById('span_estado').innerHTML="";
                if(formato_contrato != 0){
                    document.getElementById('span_formato').innerHTML="";
                    if(num_contrato.length > 0){
                        document.getElementById('span_num').innerHTML="";
                        if(fecha_inicio.length > 0){
                            document.getElementById('span_fechai').innerHTML="";
                            if(fecha_fin.length > 0){
                                document.getElementById('span_fechaf').innerHTML="";
                                if(asesorcomercial != 0){
                                    document.getElementById('span_asesor').innerHTML="";
                                     var tipoconex=$('#tipoconexion').val();
                                    if(tipoconex != 0){
                                       document.getElementById('span_tipoconex').innerHTML="";
                                       var nodo=$('#nodo').val();
                                          if(nodo != 0){
                                            document.getElementById('span_nodo').innerHTML="";
                                            var antena=$('#antena').val();
                                            if(antena != 0){
                                                $.ajax({
                                                  data:formData,
                                                  type:"POST",
                                                  url:argument,
                                                  cache: false,
                                                  contentType: false,
                                                  processData: false,
                                                  beforeSend:function(){
                                                       $('#lp').removeClass();
                                                          $('#lp').addClass('modal-dialog modal-sm');
                                                            document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>   </font>   Espera un momento,esto no tarda!";
                                                            document.getElementById('bd').innerHTML="";

                                                            $("#modalls").click();
                                                        },
                                                  success:function(response){
                                                     var print=response.split('+');
                                                                document.getElementById('bd').innerHTML=print[2];
                                                                document.getElementById('tx').innerHTML=print[1];
                                                             
                                                                 
                                                              
                                                  }

                                                });
                                            }else{
                                              document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                              document.getElementById('antena').focus();
                                            }
                                          }else{
                                            document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                            document.getElementById('nodo').focus();
                                            document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                              
                                          }
                                     }

                                    else{
                                      document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                                      document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                      document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                      document.getElementById('tipoconexion').focus();
                                            }
                                    
                                }else{
                                   document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>"        
                                    document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                                    document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                    document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                    document.getElementById('asesorcomercial').focus();
                                }
                            }else{
                                document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>"
                                document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                                document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>"; 
                                document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";       
                                document.getElementById('fecha_fin').focus();
                            }
                        }else{
                            document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>"
                            document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                            document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                            document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                            document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                            document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
                            document.getElementById('fecha_inicio').focus();
                        }
                    }else{
                        document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>"
                        document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
                        document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                        document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                        document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                      document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
                      document.getElementById('num_contrato').focus();
                    }
                
                    
                }else{
                    document.getElementById('span_formato').innerHTML="<font color='red'>Seleccione un Formato</font>";
                    document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                    document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
                    document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                    document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>"
                    document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                    document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                  document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";    
                  document.getElementById('formato_contrato').focus();
                }
            }else{
                document.getElementById('span_estado').innerHTML="<font color='red'>Seleccione un Estado</font>";
                document.getElementById('span_formato').innerHTML="<font color='red'>Seleccione un Formato</font>";
                document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>";
                document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
                document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
              document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
              document.getElementById('estadoservicio').focus();
            }
        }else{
            document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
            document.getElementById('span_tipo').innerHTML="<font color='red'>Seleccione un tipo</font>";
            document.getElementById('span_estado').innerHTML="<font color='red'>Seleccione un Estado</font>";
            document.getElementById('span_formato').innerHTML="<font color='red'>Seleccione un Formato</font>";
            document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>";
            document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
            document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
            document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
            document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
          document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
          document.getElementById('tiposervicio').focus();

        }
    }
    function RegistrarServicioPersonal(argument){
    var tiposervicio=$('#tiposervicio').val();
        var estadoservicio=$('#estadoservicio').val();
        var formato_contrato=$('#formato_contrato').val();
        var num_contrato=$('#num_contrato').val();
        var fecha_inicio=$('#fecha_inicio').val();
        var fecha_fin=$('#fecha_fin').val();
        var asesorcomercial=$('#asesorcomercial').val();
        var formData= new FormData(document.forms.namedItem("formulario3"));
        if(tiposervicio != 0){
            document.getElementById('span_tipo').innerHTML="";
            if(estadoservicio != 0){
                document.getElementById('span_estado').innerHTML="";
                if(formato_contrato != 0){
                    document.getElementById('span_formato').innerHTML="";
                    if(num_contrato.length > 0){
                        document.getElementById('span_num').innerHTML="";
                        if(fecha_inicio.length > 0){
                            document.getElementById('span_fechai').innerHTML="";
                            if(fecha_fin.length > 0){
                                document.getElementById('span_fechaf').innerHTML="";
                                if(asesorcomercial != 0){
                                    document.getElementById('span_asesor').innerHTML="";
                                     var tipoconex=$('#tipoconexion').val();
                                    if(tipoconex != 0){
                                       document.getElementById('span_tipoconex').innerHTML="";
                                       var nodo=$('#nodo').val();
                                          if(nodo != 0){
                                            document.getElementById('span_nodo').innerHTML="";
                                            var antena=$('#antena').val();
                                            if(antena != 0){
                                                $.ajax({
                                                  data:formData,
                                                  type:"POST",
                                                  url:argument,
                                                  cache: false,
                                                  contentType: false,
                                                  processData: false,
                                                  beforeSend:function(){
                                                       $('#lp').removeClass();
                                                          $('#lp').addClass('modal-dialog modal-sm');
                                                            document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>  </font>    Registrando,espera un momento!";
                                                            document.getElementById('bd').innerHTML="";

                                                            $("#modalls").click();
                                                        },
                                                  success:function(response){
                                                     var print=response.split('+');
                                                                document.getElementById('bd').innerHTML=print[2];
                                                                document.getElementById('tx').innerHTML=print[1];
                                                            
                                                  }

                                                });
                                            }else{
                                              document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                              document.getElementById('antena').focus();
                                            }
                                          }else{
                                            document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                            document.getElementById('nodo').focus();
                                            document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                              
                                          }
                                     }

                                    else{
                                      document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                                      document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                      document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                      document.getElementById('tipoconexion').focus();
                                            }
                                    
                                }else{
                                   document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>"        
                                    document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                                    document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                    document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                                    document.getElementById('asesorcomercial').focus();
                                }
                            }else{
                                document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>"
                                document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                                document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                                document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>"; 
                                document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";       
                                document.getElementById('fecha_fin').focus();
                            }
                        }else{
                            document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>"
                            document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                            document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                            document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                            document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                            document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
                            document.getElementById('fecha_inicio').focus();
                        }
                    }else{
                        document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>"
                        document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
                        document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                        document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                        document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                      document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
                      document.getElementById('num_contrato').focus();
                    }
                
                    
                }else{
                    document.getElementById('span_formato').innerHTML="<font color='red'>Seleccione un Formato</font>";
                    document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                    document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
                    document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                    document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>"
                    document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                    document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
                  document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";    
                  document.getElementById('formato_contrato').focus();
                }
            }else{
                document.getElementById('span_estado').innerHTML="<font color='red'>Seleccione un Estado</font>";
                document.getElementById('span_formato').innerHTML="<font color='red'>Seleccione un Formato</font>";
                document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>";
                document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
                document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
                document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
                document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
                document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
              document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
              document.getElementById('estadoservicio').focus();
            }
        }else{
            document.getElementById('span_tipoconex').innerHTML="<font color='red'>Seleccione un tipo</font>";
            document.getElementById('span_tipo').innerHTML="<font color='red'>Seleccione un tipo</font>";
            document.getElementById('span_estado').innerHTML="<font color='red'>Seleccione un Estado</font>";
            document.getElementById('span_formato').innerHTML="<font color='red'>Seleccione un Formato</font>";
            document.getElementById('span_num').innerHTML="<font color='red'>Digite un numero</font>";
            document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un Nodo</font>";
            document.getElementById('span_antena').innerHTML="<font color='red'>Seleccione una Antena</font>";
            document.getElementById('span_fechai').innerHTML="<font color='red'>Seleccione una Fecha de inicio</font>";
            document.getElementById('span_fechaf').innerHTML="<font color='red'>Seleccione una Fecha de Fin</font>";
          document.getElementById('span_asesor').innerHTML="<font color='red'>Seleccione un asesor Comercial</font>";        
          document.getElementById('tiposervicio').focus();

        }
    }
    
    function Antena(numero){
        
        var nodo=$('#nodo').val();
        var antena=$('#antena').val();
        var parametro={'nodo':nodo,'numero':numero};
        
        if(nodo != 0){
             document.getElementById('span_nodo').innerHTML="";
            $.ajax({
               data:parametro,
                type:"POST",
                url:"controlador/SelectAntena.php",
                success:function(response){
                    document.getElementById('Options').innerHTML=response;
                }
            });
        }else{
            document.getElementById('nodo').focus();
            document.getElementById('span_nodo').innerHTML="<font color='red'>Seleccione un nodo</font>";
        }
    }
    
    function MiCarga(nodo,antena){
         var parametro={'nodo':nodo,'numero':antena};
        
             document.getElementById('span_nodo').innerHTML="";
            $.ajax({
               data:parametro,
                type:"POST",
                url:"controlador/SelectAntena.php",
                success:function(response){
                    document.getElementById('Options').innerHTML=response;
                }
            });
    }
    
    function TipoServicio(){
    var tiposervicio=$('#tiposervicio').val();
    var parametro={'tiposervicio':tiposervicio};
    if(tiposervicio != 0){
        $.ajax({
            data:parametro,
            type:"POST",
            url:"controlador/TipoServicio.php",
            success:function(response){
                if(response == "true"){
                    document.getElementById('span_tipo').innerHTML="<font color='red'> Escoge Otro Servicio</font>";
                   document.formulario3.btn.disabled=true;
                    document.formulario3.tiposervicio.style.color="red";
                }else{
                   document.getElementById('span_tipo').innerHTML="";
                   document.formulario3.btn.disabled=false;
                   document.getElementById('tiposervicio').style.color="#000"; 
                }
            }
        });
    }
    }
    function TipoServicio2(){
    var tiposervicio=$('#tiposervicio').val();
    var parametro={'tiposervicio':tiposervicio};
    if(tiposervicio != 0){
        $.ajax({
            data:parametro,
            type:"POST",
            url:"controlador/TipoServicio.php",
            success:function(response){
                if(response == "true"){
                    document.getElementById('span_tipo').innerHTML="<font color='red'> Escoge Otro Servicio</font>";
                   document.formulario2.btn.disabled=true;
                    document.formulario2.tiposervicio.style.color="red";
                }else{
                   document.getElementById('span_tipo').innerHTML="";
                   document.formulario2.btn.disabled=false;
                   document.getElementById('tiposervicio').style.color="#000"; 
                }
            }
        });
    }
    }
    var aumentaipb=2;
    function AñadirIpBakcbone(){
        var verifica=$('#verifica').val();
        if(verifica == 1){
           var  aumentaipb=$('#Backbone').val();
            var parametro={'aumentaipb':aumentaipb};
        }else{
            var aumentaipb=$('#comparadoripb').val();
              var parametro={'aumentaipb':aumentaipb};
        }
        var parametro={'aumentaipb':aumentaipb};
        $.ajax({
           data:parametro,
           type:"POST",
            url:"controlador/anadiripBack.php",
            success:function(response){
                aumentaipb=parseFloat(aumentaipb) + 1;
                document.getElementById('verifica').value=2;
                document.getElementById('comparadoripb').value=aumentaipb;
                document.getElementById('otras_ipx').innerHTML=$("#otras_ipx").html()+response;
            }
        });
      
       }
    var aumentaipc=2;
    function AñadirIpCliente(){
        var verificaC=$('#verificaC').val();
        if(verificaC == 1){
           var aumentaipc=$('#Cliente').val();
           var parametro={'aumentaipc':aumentaipc};
        }else{
            var aumentaipc=$('#comparadoripc').val();
            var parametro={'aumentaipc':aumentaipc};
        }
        $.ajax({
           data:parametro,
           type:"POST",
            url:"controlador/anadiripCli.php",
            success:function(response){
                aumentaipc=parseFloat(aumentaipc) + 1;
                document.getElementById('verificaC').value=2;
                document.getElementById('comparadoripc').value=aumentaipc;
                document.getElementById('otras_ipC').innerHTML=$("#otras_ipC").html()+response;
            }
        });
    }
    var aumentaipeq=2;
     function AñadirIpEquipo(){
         var verificaE=$('#verificaE').val();
         if(verificaE == 1){
             var aumentaipeq=$('#Equipo').val();
            var parametro={'aumentaipeq':aumentaipeq};
         }else{
              var aumentaipeq=$('#comparadoripEq').val();
            var parametro={'aumentaipeq':aumentaipeq};
         }
        $.ajax({
           data:parametro,
           type:"POST",
            url:"controlador/anadirElementoEquipo.php",
            success:function(response){
                aumentaipeq=parseFloat(aumentaipeq) + 1;
                document.getElementById('verificaE').value=2;
                document.getElementById('comparadoripEq').value=aumentaipeq;
                document.getElementById('otras_ipEq').innerHTML=$("#otras_ipEq").html()+response;
            }
        });
     
     }
    function Email(correo){
        var cadena=$('#'+correo).val(); 
        cadena=cadena.toLowerCase();
        document.getElementById(correo).value=cadena;
    }
    /*Actualizaciones*/
    
    function ActualizarClientePersonal(cod){
            var parametro={'cod_cli':cod};
            $.ajax({
            data:parametro,
             type:"POST",
             url:"controlador/Actualizardatosclientespersonales.php",
                beforeSend:function(){
                       document.getElementById('subcontent').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
                 },
                success:function(response){
                    
                     document.getElementById('subcontent').innerHTML=response;
                    
                }

             });
         }
  function ActualizarClienteEmpresarial(cod){
            var parametro={'cod_emp':cod};
            $.ajax({
            data:parametro,
             type:"POST",
             url:"controlador/Actualizardatosclientesempresariales.php",
                beforeSend:function(){
                       document.getElementById('subcontent').innerHTML="<br><center><h3><span class='glyphicon glyphicon-dashboard'>  Cargando</span></h3></center>";
                 },
                success:function(response){
                    
                     document.getElementById('subcontent').innerHTML=response;
                    
                }

             });
         }
    function FormActualizar(argument){
         $.get(argument+".php").done(
            function(data){
                $(dom('subcontent')).html(data);
            });
    }
    function FormActualizar2(argument){
         $.get(argument+".php").done(
            function(data){
                $(dom('forms')).html(data);
            });
    }
    
     function ListarServiciosActualizarDatos(argument){
    
         $.get(argument+".php").done(
            function(data){
                $(dom('forms')).html(data);
            });
    }
     function MostrarDatosServiciosPer(argument){
    aumentaipb=2;
    aumentaipc=2; 
    aumentaipeq=2;
    console.log(aumentaipeq,aumentaipc,aumentaipb);
      var value_ser=$('#valueser').val();
      var cod_ser="";
      var tr=0;
      var compara="false";
      if(value_ser != 1){
        for( var j=0;j < value_ser;j++){
             if(document.miFormulario.mychk[j].checked){
              cod_ser =document.miFormulario.mychk[j].value;
              console.log(cod_ser);
              tr=tr+1;
              compara="true";
           }
        }
      }else{
        if(document.miFormulario.mychk.checked){
              cod_ser =document.miFormulario.mychk.value;
              console.log(cod_ser);
              tr=tr+1;
              compara="true";
          }
      }
      if(compara == "true"){
          if(tr == 1){
            document.getElementById('span_ubicacion').innerHTML="";
            var parametro={'cod_ser':cod_ser};
            $.ajax({
              data:parametro,
              type:"POST",
              url:argument,
              success:function(response){
                document.getElementById('forms').innerHTML=response;
                
              }
            });
          }else{
            document.getElementById('span_ubicacion').innerHTML="<font color='red'>Seleccione solo un Servicio</font>"
          }
      }else{
         document.getElementById('span_ubicacion').innerHTML="<font color='red'>Seleccione un Servicio para seguir</font>";
      }
  }
  
  function ActualizarDatosPersonales(argument){
        var formData= new FormData(document.forms.namedItem("formulario1"));
        var cedula=$("#cedula_persona").val();
        var Nombre=$("#1nombre_persona").val();
        var apellido=$("#1apellido_persona").val();
        var email=$("#email_persona").val();
        var mun=$("#municipio_persona").val();
        if(cedula.length > 0){
            document.getElementById("span_cedula").innerHTML="";
            if(Nombre.length > 0){
                document.getElementById("span_nombre").innerHTML="";
                if(apellido.length >0){
                    document.getElementById("span_apellido").innerHTML="";
                    if(mun !=0){
                      if(email.length > 0){
                        var expre=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if(expre.test(email)){
                            document.getElementById('span_email').innerHTML="";

                            $.ajax({
                                data:formData,
                                type:"POST",
                                url:argument,
                                cache: false,
                                contentType: false,
                                processData: false,
                                beforeSend:function(){
                                     $('#lp').removeClass();
                                     $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>   </font>    Actualizando,Esto no Tarda Mucho esperanos!";
                                    document.getElementById('bd').innerHTML="";
                                  
                                    $("#modalls").click();
                                },
                                success:function(response){
                                    document.getElementById('bd').innerHTML='<button type="button" class="btn btn-primary ac" data-dismiss="modal">  Aceptar</button>';
                                    document.getElementById('tx').innerHTML=response;
                                  }
                            });
                        }
                      
                        else{
                            document.getElementById('span_email').innerHTML="<font color='red'>Direccion de correo Invalida</font>";
                        }
                    }else{
                      document.getElementById('span_email').innerHTML="";

                            $.ajax({
                                data:formData,
                                type:"POST",
                                url:argument,
                                cache: false,
                                contentType: false,
                                processData: false,
                                 beforeSend:function(){
                                      $('#lp').removeClass();
                                        $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>   </font>  Actualizando,Esto no Tarda Mucho esperanos!";
                                    document.getElementById('bd').innerHTML="";
                                   $("#modalls").click();
                                },
                                success:function(response){
                                       document.getElementById('bd').innerHTML='<button type="button"  data-dismiss="modal" class="btn btn-primary ac">  Aceptar</button>';
                                        document.getElementById('tx').innerHTML=response;
                                }
                            });
                    }
                    }else{

                      document.getElementById('span_municipioper').innerHTML="<font color='red'>Seleccione un Municipio</font>";
                    }
                }else{
                    document.getElementById("span_apellido").innerHTML="<font color='red'>Digita almenos un Apellido</font>";
                    $("#cedula_persona").addClass("error");
                }
            }else{
                document.getElementById("span_nombre").innerHTML="<font color='red'>Digita almenos un Nombre</font>";
                $("#cedula_persona").addClass("error");
            }
        }else{
            document.getElementById("span_cedula").innerHTML="<font color='red'>Digita un numero de cedula</font>";
            $("#cedula_persona").addClass("error");
        }
    }
    function ActualizarUbicacionesPersonales(argument){
     var formData= new FormData(document.forms.namedItem("formulario2"));
        var nom_ubicacion=$("#nombre_ubicacion").val();
        var dir_ubicacion=$("#direccion_ubicacion").val();
        var mun_ubicacion=$("#municipio_ubicacion").val();
        var email_ubi=$("#email_per_ubicacion").val();
        
        if(nom_ubicacion.length > 0){
            document.getElementById("span_nombre").innerHTML="";
            if(dir_ubicacion.length > 0){
                document.getElementById("span_direccion").innerHTML="";
                if(mun_ubicacion != 0){
                    document.getElementById("span_municipio").innerHTML="";
                    if(email_ubi.length > 0){
                      var expre=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                      if(expre.test(email_ubi)){
                        document.getElementById('span_email').innerHTML="";
                        $.ajax({
                             data:formData,
                            type:"POST",
                            url:argument,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend:function(){
                                 $('#lp').removeClass();
                                $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>   </font>  Actualizando,Esto no Tarda Mucho esperanos!";
                                    document.getElementById('bd').innerHTML="";
                                   $("#modalls").click();
                                },
                                success:function(response){
                                       document.getElementById('bd').innerHTML='<button type="button" onclick="FormActualizarUbicaciones()" data-dismiss="modal" class="btn btn-primary ac">  Aceptar</button>';
                                        document.getElementById('tx').innerHTML=response;
                                        
                                }

                        });
                        }else{
                            document.getElementById('span_email').innerHTML="<font color='red'>Direccion de correo Invalida</font>";
                       
                        }
                  }else{
                     document.getElementById('span_email').innerHTML="";
                        $.ajax({
                             data:formData,
                            type:"POST",
                            url:argument,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend:function(){
                                 $('#lp').removeClass();
                                $('#lp').addClass('modal-dialog modal-sm');
                                    document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>  </font>  Actualizando,Esto no Tarda Mucho esperanos!";
                                    document.getElementById('bd').innerHTML="";
                                   $("#modalls").click();
                                },
                                success:function(response){
                                       document.getElementById('bd').innerHTML='<button type="button" onclick="FormActualizarUbicaciones()" data-dismiss="modal" class="btn btn-primary ac">  Aceptar</button>';
                                        document.getElementById('tx').innerHTML=response;
                                        
                                }

                        });
                  }
                }else{
                    document.getElementById("span_municipio").innerHTML="<font color='red'>Seleccione un Municipio</font>";  
                }
            }else{
                document.getElementById("span_direccion").innerHTML="<font color='red'>Digita direccion valida</font>";
            }
        }else{
            document.getElementById("span_nombre").innerHTML="<font color='red'>Digita un nombre de Ubicacion</font>";
        }
    }
    function Cedula(argument){
        var cedula=$('#cedula_persona').val();
        if(cedula > 0){ 
            var parametro={'cedula':cedula};
            $.ajax({
             
             data:parametro,
             type:"POST",
             url:argument,
            
            success:function(response){
               if(response == "true"){
                   $('#span_icon').addClass('glyphicon glyphicon-remove');
                        document.getElementById('span_cedula').innerHTML="<font color='red'>Este numero  ya existe</font>";
                        document.formulario1.btn.disabled=true; 
                }else{
                      
                         document.getElementById('span_cedula').innerHTML="<font color='green'> Numero Valido</font>";
                    $('#span_icon').removeClass('glyphicon glyphicon-remove');
                   $('#span_icon').addClass('glyphicon glyphicon-ok');
                   document.formulario1.btn.disabled=false;
                }
            
            }
            });
        }else{
           $('#span_icon').addClass('glyphicon glyphicon-remove');
            document.getElementById('span_cedula').innerHTML="<font color='red'>Este Numero ya existe</font>";
            document.formulario1.btn.disabled=true;
        }
    }
     function Celular(){
         var celular=$('#celular_persona').val();
         if(celular.length >  0 ){
             if(celular.length > 11 ){
                document.getElementById('span_celular').innerHTML="<font color='red'> Numero de caracteres mayor a 11</font>";
                document.formulario1.celular_persona.style.color="#ff0000";
                document.formulario1.celular_persona.style.border="1px solid red";
                document.formulario1.btn.disabled=true;
               }else{
               document.getElementById('span_celular').innerHTML="";
                document.formulario1.celular_persona.style.color="#000";
                document.formulario1.celular_persona.style.border="1px solid #D9D9D9";
                document.formulario1.btn.disabled=false;
               }
        }else{
            document.getElementById('span_celular').innerHTML="";
        }
     }
     function CelularUbiPer(){
         var celular=$('#celular_per_ubicacion').val();
         if(celular.length >  0 ){
             if(celular.length > 11 ){
                document.getElementById('span_celular').innerHTML="<font color='red'> Numero de caracteres mayor a 11</font>";
                document.formulario2.celular_per_ubicacion.style.color="#ff0000";
                document.formulario2.celular_per_ubicacion.style.border="1px solid red";
                document.formulario2.btn.disabled=true;
               }else{
               document.getElementById('span_celular').innerHTML="";
                document.formulario2.celular_per_ubicacion.style.color="#000";
                document.formulario2.celular_per_ubicacion.style.border="1px solid #D9D9D9";
                document.formulario2.btn.disabled=false;
               }
        }
    }
    function NumeroContrato(){
        var num_contrato=$('#num_contrato').val();
        var formato_contrato=$('#formato_contrato').val();
        
        if(formato_contrato != 0){
            document.getElementById("span_formato").innerHTML="";
            var parametro={'num_contrato':num_contrato,'formato_contrato':formato_contrato};
            $.ajax({
            data:parametro,
            type:"POST",
            url:"controlador/NumeroContrato.php",
            success: function (response){
                if(response == "true"){
                    document.getElementById('span_num').innerHTML="<font color='red'> Este Numero Ya existe</font>";
                   document.formulario3.num_contrato.style.color="#ff0000";
                   document.formulario3.num_contrato.style.border="1px solid red";
                   document.formulario3.btn.disabled=true;
                  }else{
                    document.getElementById('span_num').innerHTML="";
                     document.formulario3.num_contrato.style.color="#000";
                     document.formulario3.num_contrato.style.border="1px solid #D9D9D9";
                     document.formulario3.btn.disabled=false;
               }
           }
            });
            
        }else{
            document.getElementById("span_formato").innerHTML="<font color='red'>seleccione un formato</font>";
            document.getElementById('formato_contrato').focus();
        }
    }
    function NumeroContrato2(){
        var num_contrato=$('#num_contrato').val();
        var formato_contrato=$('#formato_contrato').val();
        
        if(formato_contrato != 0){
            document.getElementById("span_formato").innerHTML="";
            var parametro={'num_contrato':num_contrato,'formato_contrato':formato_contrato};
            $.ajax({
            data:parametro,
            type:"POST",
            url:"controlador/NumeroContrato.php",
            success: function (response){
                if(response == "true"){
                    document.getElementById('span_num').innerHTML="<font color='red'> Este Numero Ya existe</font>";
                   document.formulario2.num_contrato.style.color="#ff0000";
                   document.formulario2.num_contrato.style.border="1px solid red";
                   document.formulario2.btn.disabled=true;
                  }else{
                    document.getElementById('span_num').innerHTML="";
                     document.formulario2.num_contrato.style.color="#000";
                     document.formulario2.num_contrato.style.border="1px solid #D9D9D9";
                     document.formulario2.btn.disabled=false;
               }
           }
            });
            
        }else{
            document.getElementById("span_formato").innerHTML="<font color='red'>seleccione un formato</font>";
            document.getElementById('formato_contrato').focus();
        }
    }
    /*Consulta de 25 clientes Personales*/
   /*las consultas de clientes personales se llevaran a en el archivo vista/include/reg_clientes_personales.php
   /**/

   /**/

    /*en esta parte se realizaran todas las funciones necesarias para el registro de clientes personales*/
    /**/
    /**/
    /**/
    /**/
    /**/
    /*Cada Funcion Tendra Un Nombre,en el cual se reflejara la accion a realizar*/
    /**/
    /**/
    /*Esta funcion Preguntara si el nit o cedula existe,si existe muestra los datos, si no existe mostrara el formulario de registro*/
    function VerificarNit(){
    var nit_empresa=$('#nit_empresa').val();
      var parametro={'nit_empresa':nit_empresa};
      if(nit_empresa.length > 0){
         document.getElementById('span_nit').innerHTML="";
         $.ajax({
           data:parametro,
           type:"POST",
           url:"controlador/verificarnit.php",
            success:function(response){
              var prin=response;
              var arreglo=prin.split("+");
              if(arreglo[0] != "false"){
                document.getElementById('span_nit').innerHTML="<font color='blue'>Este Usuario ya existe</font>";
                document.getElementById('verificarc').innerHTML=arreglo[1];
              }else{
                document.getElementById('span_nit').innerHTML="";
                     var argument="vista/include/formulariodatosEmpresariales";

                               $.get(argument+".php").done(
                                function(data){
                                    $(dom('subcontent')).html(data);
                                });
              }
              
            }
         })
      }else{
        document.getElementById('span_nit').innerHTML="<font color='red'>Digite un nit o numero De Cedula</font>"
      }
    }
    /**/
     /**/
     /**/
     /**/
    /* Funciones de gestionar Incidencias*/
     /**/
     /**/
     /**/
     /**/
    
    function Incidencias(cod_cli,comparador){
        var parametro={'cod_cli':cod_cli,'comparador':comparador};
        $.ajax({
           data:parametro,
           type:"POST",
           url:"controlador/Incidencias.php",
           success:function(){
               $.get("controlador/Incidencias.php").done(
               function(data){
                   $(dom('subcontent')).html(data);
               });
           }
        });
    }
    function ServiciosIncidencias(cod,servicio,icon){
        var parametro={'cod':cod};
        $.ajax({
            data:parametro,
            type:"POST",
            url:"controlador/serviciosIncidencias.php",
            
            success:function(response){
            document.getElementById(icon).innerHTML='<a  onclick="OcultarServicios(\''+cod+'\',\''+servicio+'\',\''+icon+'\')" class="float" id="cursor"> <span class="glyphicon glyphicon-chevron-up"></span></a>'
            document.getElementById(servicio).innerHTML=response;
            }
        });
    }
    function OcultarServicios(cod,servicio,icon){
         document.getElementById(icon).innerHTML='<a  onclick="ServiciosIncidencias(\''+cod+'\',\''+servicio+'\',\''+icon+'\')" class="float" id="cursor"> <span class="glyphicon glyphicon-chevron-down"></span></a>'
         document.getElementById(servicio).innerHTML="";
    }
    function MostrarIncidencias(cod_ser,cod_ubi,comparador){
        var parametro={'codser':cod_ser,'codubi':cod_ubi,'misIncidencias':comparador};
        $.ajax({
            data:parametro,
            type:"POST",
            url:"controlador/MostrarIncidencias.php",
            
            success:function(response){
                 $.get("controlador/MostrarIncidencias.php").done(
                 function(data){
                    $(dom('ubis')).html(data); 
                 });
            } 
             
        });
    }
    
    function Archivo(Imprimir,argument,numero){
        var formData= new FormData($(".formulario1")[0]);
        $.ajax({
            data:formData,
            type:"POST",
            url:argument,
            cache: false,
            contentType:false,
            processData:false,
            beforeSend:function(){
                document.getElementById(Imprimir).innerHTML='<br><br><div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"> 50%  subiendo</div></div>';
            },
            success:function(response) {
                var print=response.split('+');
              document.getElementById(Imprimir).innerHTML=print[1];
              document.getElementById('valorImagen'+numero).value=print[2];
                
            }
        });
    }
    function VerArchivo(url,comparador){
        if(comparador == 1){
            $('#lp').removeClass();
            $('#lp').addClass('modal-dialog');
              document.getElementById('tx').innerHTML="<img src="+url+" style='width:380px;height:350px;'>";
             document.getElementById('bd').innerHTML="<a type='button' onclick='Descargar(\""+url+"\")' class='btn btn-success'  data-dismiss='modal'>Descargar <span class='glyphicon glyphicon-download'></span></a>";
         $("#modalls").click();
        }else{
            if(comparador == 2){
                $('#lp').removeClass();
                $('#lp').addClass('modal-dialog');
                  document.getElementById('tx').innerHTML="<video src="+url+" style='width:380px;height:350px;' controls >el video vale</video>";
                  document.getElementById('bd').innerHTML="<a type='button' onclick='Descargar(\""+url+"\")' class='btn btn-success'  data-dismiss='modal'>Descargar <span class='glyphicon glyphicon-download'></span></a>";
                $("#modalls").click();
            }else{
                $('#lp').removeClass();
                $('#lp').addClass('modal-dialog modal-sm');
                  document.getElementById('tx').innerHTML="<div class='alert alert-warning' role='alert'><h4> Deseas Descargar Este Archivo</h4><br><a  onclick='Descargar(\""+url+"\")'  data-dismiss='modal' class='btn btn-success'>Si <span class='glyphicon glyphicon-download'></span></a></div>";
                  document.getElementById('bd').innerHTML='';
                $("#modalls").click();
            }
        }
    }
    function Descargar(url){
      var win = window.open(url, '_blank');
        win.focus()
    }
    function CrearIncidencia(argument,numero){
        var tecnicoR=$('#TecnicoResponsable').val();
        var numerosopor=$('#numerosopor').val()
         if(tecnicoR != 0){
                document.getElementById('tecnicoresponsable').innerHTML="";
                var descripcion=$('#descripcionServicio'+numero).val();
           
                if(descripcion.length > 0){
                    document.getElementById('descripcion'+numero).innerHTML="";
                      var formData= new FormData($(".formulario1")[0]);
                    $.ajax({
                       data:formData,
                       type:'POST',
                       url:argument,
                       cache: false,
                       contentType: false,
                        processData:false,
                        beforeSend:function(){
                            $('#lp').removeClass();
                             $('#lp').addClass('modal-dialog modal-sm');
                             document.getElementById('tx').innerHTML="<font color='blue'> <img src='vista/img/load.gif' style='width:70px;height:50px;'>  </font>   Espera un momento, esto no tarda!";
                             document.getElementById('bd').innerHTML='';
                             $("#modalls").click();
                          },
                             success:function(response) {
                                 var print=response.split('+');
                                 document.getElementById('tx').innerHTML=print[1];
                                 document.getElementById('bd').innerHTML=print[2];
                             }
                    });
                }else{
                    document.getElementById('descripcion'+numero).innerHTML="<font color='red'> Escribe una descripcion del problema</font>";
                    document.getElementById('descripcionServicio'+numero).focus();
                }
        }else{
                document.getElementById('tecnicoresponsable').innerHTML="<font color='red'> Seleccione un Responsable</font>";
                document.getElementById('TecnicoResponsable').focus();
            }
    }
    function MisIncidencias(pagina){
            var parametro={'pag':pagina};
                $.ajax({
                    data:parametro,
                    type:"POST",
                    url:"vista/include/misIncidencias.php",
                    success:function(response){
                         $.get("vista/include/misIncidencias.php").done(
                             function(data){
                                $(dom('incidencias')).html(data); 
                             });
                       
                    }
                });
    }
    function MostrarDetallesTecnicos(cod_inc,cod_ser,con){
            var parametro={'cod_inc':cod_inc,'cod_ser':cod_ser,'con':con};
                $.ajax({
                    data:parametro,
                    type:"POST",
                    url:"controlador/MisServicios.php",
                    success:function(response){
                         $.get("controlador/MisServicios.php").done(
                             function(data){
                                $(dom('subcontent')).html(data); 
                             });
                       
                    }
                });
    }
    function CerrarIncidencia(){
        var solucion=$('#solucion1').val();
        var formData= new FormData($(".formulario1")[0]);
                if(solucion.length > 0){
                    document.getElementById('solucionF1').innerHTML="";
                    $.ajax({
                       data:formData,
                       type:'POST',
                       url:"controlador/CerrarIncidencia.php",
                       cache: false,
                       contentType: false,
                        processData:false,
                        beforeSend:function(){
                            $('#lp').removeClass();
                             $('#lp').addClass('modal-dialog modal-sm');
                             document.getElementById('tx').innerHTML="<font color='blue'><img src='vista/img/load.gif' style='width:70px;height:50px;'> </font>   Espera un momento, esto no tarda!";
                             document.getElementById('bd').innerHTML='';
                             $("#modalls").click();
                          },
                             success:function(response) {
                                 var print=response.split('+');
                                 document.getElementById('tx').innerHTML=print[1];
                                 document.getElementById('bd').innerHTML=print[2];
                             }
                    });
                }else{
                    document.getElementById('solucion1').focus();
                    document.getElementById('solucionF1').innerHTML="<font color='red'> Escribe una solucion aplicada</font>";
                     
                }
           
    }
    function NuevoSoporte(cod_inc){
        var parametro={'cod_inc':cod_inc};
        $.ajax({
           data:parametro,
            type:"POST",
            url:"controlador/NuevoSoporte.php",
            
            success:function(response){
                var print=response.split('+');
                if(print[0] == 'true'){
                document.getElementById('nuevoS').value="true";
                document.getElementById('ns').innerHTML="";
                          $.get("controlador/NuevoSoporte.php").done(
                             function(data){
                                $(dom('nuevosoporte')).html(data); 
                           });
                }else{
                    document.getElementById('resul').innerHTML=response;
                }
            }
        });
    }
    /**/
    /*modulo de informes*/
    /**/
    function GenerarPor(){
        var buscar=$('#generarpor').val();
        if(buscar == 0 || buscar == 1){
            document.getElementById('mostrar').innerHTML='<input type="hidden" id="busqueda" name="busqueda" value="">';
        }else{
             var parametro={'por':buscar};
            $.ajax({
               data:parametro,
                type:"POST",
                url:'vista/include/GenerarPor.php',
                success:function(response){
                    document.getElementById('mostrar').innerHTML=response;
                }
            });
        }
    }
     function GenerarPorGeneral(){
        var buscar=$('#generarpor').val();
         if(buscar != 0){
             var parametro={'por':buscar};
                $.ajax({
                   data:parametro,
                    type:"POST",
                    url:'vista/include/GenerarPorGeneral.php',
                    success:function(response){
                        document.getElementById('mostrar').innerHTML=response;
                    }
                });
         }
        
    }
    function GenerarInforme(argument){
        var fechaInicio=$('#fechainicio').val();
        var fechaFin=$('#fechafin').val();
        var generarpor=$('#generarpor').val();
        var formData=new FormData(document.forms.namedItem("formulario1"));
        if(fechaInicio.length > 0){
             document.getElementById('span_fechaInicio').innerHTML="";
            if(fechaFin.length > 0){
                document.getElementById('span_fechaFin').innerHTML="";
                if(generarpor != 0){
                    document.getElementById('span_generarPor').innerHTML="";
                        if(generarpor != 1){
                            var busqueda=$('#busqueda').val();
                            if(busqueda != 0){
                                document.getElementById('span_busqueda').innerHTML="";
                                document.getElementById('mireporte').innerHTML="<br><center><h3><img src='vista/img/load.gif' style='width:70px;height:50px;'><br><br>Cargando.. </h3></center><br><br>";
                                
                                $("#asd").hide(1500,function(){
                                    
                                    $.ajax({
                                    
                                   data:formData,
                                   type:"POST",
                                   url:argument,
                                   cache:false,
                                   processData:false,
                                   contentType:false,
                                   success:function(response){
                                       
                                       document.getElementById('mireporte').innerHTML=response;
                                   }
                                    
                                });
                                    $("#asd").show();
                                });
                                
                            }else{
                                 document.getElementById('span_busqueda').innerHTML="<font color='red'>Seleccione una opcion</font>";
                            }
                        }else{
                             document.getElementById('mireporte').innerHTML="<br><center><h3><img src='vista/img/load.gif' style='width:70px;height:50px;'><br><br>Cargando.. </h3></center><br><br>";
                                
                                $("#asd").hide(1000,function(){
                                    
                                    $.ajax({
                                    
                                   data:formData,
                                   type:"POST",
                                   url:argument,
                                   cache:false,
                                   processData:false,
                                   contentType:false,
                                   success:function(response){
                                       
                                       document.getElementById('mireporte').innerHTML=response;
                                   }
                                    
                                });
                                    $("#asd").show();
                                });
                            
                        }
                }else{
                    document.getElementById('span_generarPor').innerHTML="<font color='red'>Seleccione una opcion</font>";
                }
            }else{
                document.getElementById('span_fechaFin').innerHTML="<font color='red'>Seleccione un fecha</font>";
            }
        }else{
            document.getElementById('span_fechaInicio').innerHTML="<font color='red'>Seleccione un fecha</font>";
        }
    }
    function GenerarInformeGeneral(){
        var generarpor  =   $('#generarpor').val();
        var numero      =   $('#numero').val();
        if(generarpor != 0){
            document.getElementById('span_generarPor').innerHTML="";
            var busqueda=$('#busqueda').val();
            if(busqueda != 0){
                document.getElementById('span_busqueda').innerHTML="";
                 document.getElementById('mireporte').innerHTML="<br><center><h3><img src='vista/img/load.gif' style='width:70px;height:50px;'><br><br>Cargando.. </h3></center><br><br>";
                 var parametro={'generarpor':generarpor,'busqueda':busqueda,'numRegistros':numero};
                
                    $("#asd").hide(1500,function(){
                        $.ajax({
                           data:parametro,
                           type:"POST",
                           url:"controlador/GenerarInformeGeneral.php",
                            success:function(response){
                                document.getElementById('mireporte').innerHTML=response;
                            }
                        });
                                     $("#asd").show();
                         });
            }else{
                document.getElementById('span_busqueda').innerHTML="<font color='red'>No puede estar vacio</font>";
            }
        }else{
            document.getElementById('span_generarPor').innerHTML="<font color='red'>Seleccione una opcion</font>";
        }
    }
    function PrevInforme(argument,numper,numRegistros,numPagina,gt){
        var parametro={'numRegistros':numRegistros,'numPagina':numPagina,'numPer':numper,'gt':gt};
       $.ajax({
          data:parametro,
          type:"POST",
          url:argument,
              
          success:function(response){
            document.getElementById('mireporte').innerHTML=response;
         }
       });
    }
    function DowloandInforme(){
            var fechaInicio=$('#fechainicio').val();
            var fechaFin=$('#fechafin').val();
            var generarpor=$('#generarpor').val();
            var busqueda=$('#busqueda').val();
        
            var url="vista/DescargarInforme.php?fechainicio="+fechaInicio+"&fechafin="+fechaFin+"&generarpor="+generarpor+"&busqueda="+busqueda;
         var win = window.open(url, '_blank');
        win.focus()
        
        
    }
    function DowloandInformeGeneral(){
         var generarpor  =   $('#generarpor').val();
        var numero      =   $('#numero').val();
         if(generarpor != 0){
            document.getElementById('span_generarPor').innerHTML="";
            var busqueda=$('#busqueda').val();
            if(busqueda != 0){
                document.getElementById('span_busqueda').innerHTML="";
                 var url="vista/DescargarInformeGeneral.php?generarpor="+generarpor+"&busqueda="+busqueda;
                 var win = window.open(url, '_blank');
                win.focus()
               
            }else{
                document.getElementById('span_busqueda').innerHTML="<font color='red'>No puede estar vacio</font>";
            }
        }else{
            document.getElementById('span_generarPor').innerHTML="<font color='red'>Seleccione una opcion</font>";
        }
    }
    </script> 
    <script>
        $(document).ready(function(){
          $("#precarga").hide(2000,function(){
            $("#container").css("visibility","visible");
            $("#precarga").hide();
              });
        });
        </script>
    <div id="asd">
        
    </div>
    <div id="bj">
        
    </div>
</html>
<?php

}
?>