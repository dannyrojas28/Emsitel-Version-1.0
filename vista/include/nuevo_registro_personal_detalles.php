<?php

include ('../../modelo/Datos.php');

session_start();


$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['tiposervicio'])){
     $tiposervicio=$_POST['tiposervicio'];
     $estadoservicio=$_POST['estadoservicio'];
     $formato_contrato=$_POST['formato_contrato'];
     $num_contrato=$_POST['num_contrato'];
     $fecha_inicio=$_POST['fecha_inicio'];
     $fecha_fin=$_POST['fecha_fin'];
     $asesorcomercial=$_POST['asesorcomercial'];
     $descripcion_contrato=$_POST['descripcion_contrato'];
    
    $datosF->tiposervicio = $tiposervicio;
    $datosF->estadoservicio = $estadoservicio;
    $datosF->formato_contrato = $formato_contrato;
    $datosF->num_contrato = $num_contrato;
    $datosF->fechaini = $fecha_inicio;
    $datosF->fechafin= $fecha_fin;
    $datosF->asesorcomercial = $asesorcomercial;
    $datosF->descripcion_contrato = $descripcion_contrato;
    
    
    
}
if(!empty($_POST['tipoconexion'])){
    $tipoconex=$_POST['tipoconexion'];
     $direccionIp1=$_POST['direccionIp1'];
     $descripcionIp1=$_POST['descripcionIp1'];
     $direccionIp2=$_POST['direccionIp2'];
     $descripcionIp2=$_POST['descripcionIp2'];
     $direccionIpc1=$_POST['direccionIpc1'];
     $descripcionIpc1=$_POST['descripcionIpc1'];
     $direccionIpc2=$_POST['direccionIpc2'];
     $descripcionIpc2=$_POST['descripcionIpc2'];
     $velocidadmax=$_POST['velocidadmax'];
     $velocidadmin=$_POST['velocidadmin'];
     $nodo=$_POST['nodo'];
     $antena=$_POST['antena'];
     $equipo=$_POST['equipo'];
     $mac=$_POST['mac'];
     $descripcionserial=$_POST['descripcionserial'];
     
     $datosF->tipoconexion=$tipoconex;
     $datosF->dirIp1=$direccionIp2;
     $datosF->descripcionip1=$descripcionIp1;
     $datosF->dirIp2=$direccionIp2;
     $datosF->descripcionip2=$descripcionIp2;
     $datosF->dirIpc1=$direccionIpc1;
     $datosF->descripcionipc1=$descripcionIpc1;
     $datosF->dirIpc2=$direccionIpc2;
     $datosF->descripcionipc2=$descripcionIpc2;
     $datosF->velocidadmax=$velocidadmax;
     $datosF->velocidadmin=$velocidadmin;
     $datosF->nodo=$nodo;
     $datosF->antena=$antena;
     $datosF->equipos=$equipo;
     $datosF->mac_serial=$mac;
     $datosF->descripcionmac=$descripcionserial;  
    
}
$_SESSION['datosF'] = $datosF;

?>
<script type="text/javascript">
    var tipoconexion=$('#select1').val();
    var equipo=$('#select2').val();
    document.getElementById('tipoconexion').value=tipoconexion
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
      <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_detalles')">Detalles Tecnicos</a></li>

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
      <li><a id="cursor" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_detalles')">Detalles Tecnicos</a></li>

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
                <form method="post" name="formulario4" enctype="multipart/form-data">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Detalles Tecnicos</h3>
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-12 "><br>
                        <label id="examplePass">Tipo de Conexion</label>
                           <select class="form-control" name="tipoconexion" id="tipoconexion">
                            <option value="0">Seleccione el Tipo</option>
                             <?php
                                $query2=$datosF->BD_TipoConexion();
                                while($row=mysqli_fetch_array($query2)){
                                    echo '<option value="'.$row['cod_con'].'">'.$row['nombre_con'].'</option>';
                                }
                            ?>
                        </select>
                        <span id="span_tipoconex"></span><br>
                     </div>
                </div>
                     <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Velocidad Maxima</label>
                        <input type="number" class="form-control" placeholder="Velocidad Maxima" id="velocidadmax" name="velocidadmax" value="<?php echo $datosF->velocidadmax;?>">
                    
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Velocidad Minima</label>
                        <input type="number" class="form-control" placeholder="Velocidad Minima" id="velocidadmin" name="velocidadmin" value="<?php echo $datosF->velocidadmin;?>">
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-6">
                        <label id="examplePass">Nodo</label>
                        <select class="form-control" id="nodo" name="nodo">
                            <option value="0">Seleccione el Tipo</option>
                            <?php
                                $query2=$datosF->BD_Nodo();
                                while($row=mysqli_fetch_array($query2)){
                                    if($row['cod_nod'] != 0){
                                            echo '<option value="'.$row['cod_nod'].'">'.$row['nombre_nod'].'</option>';
                                        }
                                }
                            ?>
                            
                        </select> <span id="span_nodo"></span><br>
                     </div>
                    
                    <div class="col-xs-12 col-sm-6">
                        <label id="examplePass">Antena</label>
                        <select class="form-control" id="antena" name="antena" >
                            <option value="0">Seleccione el Tipo</option>
                            <?php
                                $query2=$datosF->BD_Antena();
                                while($row=mysqli_fetch_array($query2)){
                                    if($row['cod_ant']){
                                    echo '<option value="'.$row['cod_ant'].'">'.$row['nombre_ant'].'</option>';
                                    }
                                }
                            ?>
                            
                        </select><span id="span_antena"></span> <br>
                     </div>
                </div>
                <input type="hidden" id="select1" value="<?php echo $datosF->tipoconexion;?>">
               <div class="col-xs-12 ip">

                 <a  onclick="AñadirIpBakcbone()" class="float" id="cursor"> <span class="glyphicon glyphicon-plus-sign"></span></a>
                    
                    <label id="examplePass">IP BACKBONE</label>
                </div>
                    
                <div class="col-xs-7">
                               <label id="examplePass">Direccion Ip #1</label>
                              <div class="input-group">
                                   
                                        <select  id="sm"  class="form-control"  name="rangoipB1">
                                            <option value="0">..Rango Ip..</option>
                                            <?php
                                                $query2=$datosF->BD_IpBakbone();
                                                while($row=mysqli_fetch_array($query2)){
                                                    if($row['cod_ipb'] != 0){
                                                            echo '<option value="'.$row['formato_ipb'].'">'.$row['formato_ipb'].'</option>';
                                                        }
                                                }
                                            ?>

                                        </select>
                                  
                                   
                                               <input type="number"  class="form-control input-group-addon"   maxlength='3' onkeyup="javascript:validateIp('direccionIp1','descripcionIp1')" name="direccionIp1"id="sm2" value="0">
                                    </div>
                             </div>  
                           
                          
                              <div class="col-xs-5">
                                    <label id="examplePass">Descripcion</label><br>
                                    <input type="text" class="form-control"  placeholder="Descripcion Ip 1" name="descripcionIp1"id="descripcionIp1" >
                                    <br>
                             </div>
                    
                    
                      
                    <br>
              
                <div id="otras_ipx">


                </div>
                <input type="hidden" name="comparadoripb"id="comparadoripb" value="1">
                <input type="hidden" name="comparadoripc" id="comparadoripc" value="1">
                <input type="hidden" name="comparadoripEq" id="comparadoripEq" value="1">
                 <input type="hidden" name="verifica" id="verifica" value="2">
                <input type="hidden" name="verificaC" id="verificaC" value="2">
                <input type="hidden" name="verificaE" id="verificaE" value="2">

                 <div class="col-xs-12 ip">
                     <a  onclick="AñadirIpCliente()" class="float" id="cursor"> <span class="glyphicon glyphicon-plus-sign"></span></a>
                    
                    <label id="examplePass">IP CLIENTE</label>
                </div>
                <div class="form-group"><br>
                        <div class="col-xs-7">
                             <label id="examplePass">Direccion Ip #1</label>
                             <div class="input-group">
                                   
                                        <select  id="sm"  class="form-control"  name="rangoipC1">
                                            <option value="0">..Rango IP..</option>
                                            <?php
                                                $query2=$datosF->BD_IpCliente();
                                                while($row=mysqli_fetch_array($query2)){
                                                    if($row['cod_ipC'] != 0){
                                                            echo '<option value="'.$row['formato_ipC'].'">'.$row['formato_ipC'].'</option>';
                                                        }
                                                }
                                            ?>

                                        </select>
                                   <input type="number" class="form-control input-group-addon"  maxlength='3' onkeyup="javascript:validateIp('direccionIpc1','descripcionIpc1')"name="direccionIpc1"id="sm2" value="0"> 
                                  </div>
                             </div>
                        <div class="col-xs-5">
                            <label id="examplePass">Descripcion</label>
                            <input type="text" class="form-control" placeholder="Descripcion Ip 1" name="descripcionIpc1"id="descripcionIpc1" >
                            <br>
                        </div>
                    <br>
                 </div>
                
                <div id="otras_ipC">

                </div>
                <div class="col-xs-12 ip">
                     <a  onclick="AñadirIpEquipo()" class="float" id="cursor"> <span class="glyphicon glyphicon-plus-sign"></span></a>
                    
                    <label id="examplePass">Equipos</label>
                </div>
                 <div class="form-group">  <br>
                        <div class="col-xs-6">
                           <label id="examplePass">Elemento #1</label><br>
                             <select  id="elementoE"  class="form-control"  name="elementoE1">
                                            <option value="0">Seleccione el Rango</option>
                                            <?php
                                                $query2=$datosF->BD_Elementos();
                                                while($row=mysqli_fetch_array($query2)){
                                                    if($row['cod_ele'] != 0){
                                                            echo '<option value="'.$row['cod_ele'].'">'.$row['nombre_ele'].'</option>';
                                                        }
                                                }
                                            ?>

                                        </select> 
                    </div>
                        
                    <div class="col-xs-6">
                        <label id="examplePass">Direccion Mac/Serial</label><br> 
                            <input type="text" class="form-control"  name="direccionmac1"id="direccioncmac1" value="0"> 
                        <br>
                    </div>
                
                    
                    <div class="col-xs-12 ">
                        <label id="examplePass">Descripcion</label>
                        <input type="text" class="form-control" placeholder="descripcion serial" id="descripcionserial1" name="descripcionserial1" >
                        <br>
                     </div>
                </div>
                 
                
                <div id="otras_ipEq">
                </div>
                 <div class="col-xs-12">
                    <div class="form-group">

                    <input type="checkbox" onclick="Verificar()" >
                    Guardar Cambios 
                    </div>
                </div>
                <div class="col-xs-12">
                <span id="span_error"></span>
                <center>
                    <button type="button" onclick="CargarSubContenido('vista/include/nuevo_registro_personal_servicio')" class="btn btn-success"> <span class="glyphicon glyphicon-chevron-left"></span>   Regresar</button>
                     <?php
                        if($_SESSION['cliente'] == "personal"){
                     ?>
                         <button type="button" name="btn" id="btn" onclick="RegistrarClientes('controlador/registrar_cliente_personal.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Registrar</button> <br>
                         <?php
                        }else{
                         ?>
                         <button type="button" name="btn" id="btn" onclick="RegistrarClientes('controlador/registrar_cliente_empresarial.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Registrar</button> <br>
                         <?php 
                        }
                         ?>
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