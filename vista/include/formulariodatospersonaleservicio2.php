<?php

include ('../../modelo/Datos.php');
session_start();
$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
?>
<script type="text/javascript">
    document.getElementById('tiposervicio').focus();
    
</script>

                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <a  onclick="cerrarForm()" class="float" id="cursor"> <span class="glyphicon glyphicon-remove-circle"></span></a>
                    
                    <h3>Tipo del servicio</h3>
                    </div>
                </div>
                <form name="formulario3" enctype="multipart/form-data">
                <div class="form-group">   
                    <div class="col-sm-6 col-xs-12"><br>
                         <label id="examplePass">Tipo de Servicio</label>
                        <select class="form-control" onclick="TipoServicio()" id="tiposervicio" name="tiposervicio"> 
                            <?php
                                $query=$datosF->BD_TiposServicio();
                                while($row=mysqli_fetch_array($query)){
                                    echo '<option value="'.$row['cod_tp'].'" >'.$row['nombre_tp'].'</option>';
                                }
                            ?>
                           
                        </select>
                         <span id="span_tipo"></span>
                    </div>
                     
                    <div class="col-sm-6 col-xs-12"><br>
                         <label id="examplePass">Estado del Servicio</label>
                        <select class="form-control" id="estadoservicio" name="estadoservicio">
                            <?php
                                $query2=$datosF->BD_EstadoServicio();
                                while($row=mysqli_fetch_array($query2)){
                                    echo '<option value="'.$row['cod_est'].'">'.$row['nombre_est'].'</option>';
                                }
                            ?>
                        </select>
                         <span id="span_estado"></span>
                         <br>
                    </div>
                  </div>
                <div class="form-group">  
                     <div class="col-sm-6 col-xs-12"><br>
                        <label id="examplePass">Formato de Contrato</label>
                        <select class="form-control" id="formato_contrato" name="formato_contrato">
                            <?php
                                if($_SESSION['cliente'] == "personal"){
                                    $query2=$datosF->BD_FormatosContrato();
                                    while($row=mysqli_fetch_array($query2)){
                                        echo '<option value="'.$row['cod_for'].'">'.$row['nombre_for'].'</option>';
                                    }
                                }else{
                                        $query2=$datosF->FormatoContratoEmpresas();
                                        while($row=mysqli_fetch_array($query2)){
                                            echo '<option value="'.$row['cod_forE'].'">'.$row['nombre_forE'].'</option>';
                                        }
                                    }
                            ?>
                        </select>
                        <span id="span_formato"></span>
                    </div>
                    <div class="col-sm-6 col-xs-12"><br>
                        <label id="examplePass">Nº de Contrato</label>
                        <input type="number" class="form-control" onkeyup="NumeroContrato()" placeholder="Nº Contrato" name="num_contrato" id="num_contrato">
                        <span id="span_num"></span><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Fecha De Inicio</label>
                        <input type="date" class="form-control"  id="fecha_inicio" name="fecha_inicio">
                        <span id="span_fechai"></span>
                        
                    </div>
               
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Fecha De Fin</label>
                        <input type="date" class="form-control"  id="fecha_fin" name="fecha_fin">
                        <span id="span_fechaf"></span>
                        <br>
                    </div>
                </div>
                
                 <div class="col-xs-12">
                         <label id="examplePass">Asesor Comercial</label>
                        <select class="form-control" id="asesorcomercial" name="asesorcomercial">
                        <option value="0">Seleccione el asesor</option>
                            <?php
                                $query2=$datosF->BD_AsesorComercial();
                                while($row=mysqli_fetch_array($query2)){
                                    echo '<option value="'.$row['cod_ase'].'">'.$row['nombre_ase']." ".$row['apellido_ase'].'</option>';
                                }
                            ?>
                        </select>
                         <span id="span_asesor"></span>
                         <br>
                    </div>
                <input type="hidden" id="asesorcomercials" value="">
                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <label id="examplePass">Descripcion Comercial</label>
                        <input type="text" class="form-control" placeholder="Este campo queda abierto para ingresar en modo texto 
                                                                             debido al grado de personalización y detalle que presentan algunas soluciones solicitadas por los clientes." id="descripcion_contrato" name="descripcion_contrato" value="">
                        <span id="span_telefono"></span><br>
                    </div>
                </div>
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
                        <div class="col-sm-6 col-xs-12"><br>
                        <label id="examplePass">Velocidad Maxima</label>
                        <input type="number" class="form-control" placeholder="Velocidad Maxima" id="velocidadmax" name="velocidadmax" >
                        <br>
                    </div>
                
                    <div class="col-sm-6 col-xs-12">
                        <br>
                        <label id="examplePass">Velocidad Minima</label>
                        <input type="number" class="form-control" placeholder="Velocidad Minima" id="velocidadmin" name="velocidadmin">
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-6">
                        <label id="examplePass">Nodo</label>
                        <select class="form-control"  id="nodo"   name="nodo">
                            <option value="0">Seleccione el Tipo</option>
                            <?php
                                $query2=$datosF->BD_Nodo();
                                while($row=mysqli_fetch_array($query2)){
                                    if($row['cod_nod'] != 0){
                                    echo '<option value="'.$row['cod_nod'].'">'.$row['nombre_nod'].'</option>';
                                    }
                                }
                            ?>
                            
                        </select>
                        <span id="span_nodo"></span>
                        <br>
                     </div>
                    
                    <div class="col-xs-12 col-sm-6">
                        <label id="examplePass">Antena</label>
                        <select class="form-control" id="antena" name="antena" >
                            <option value="0">Seleccione el Tipo</option>
                            <?php
                                $query2=$datosF->BD_Antena();
                                while($row=mysqli_fetch_array($query2)){
                                     if($row['cod_ant'] != 0){
                                    echo '<option value="'.$row['cod_ant'].'">'.$row['nombre_ant'].'</option>';
                                    }
                                }
                            ?>
                            
                        </select>
                        <span id="span_antena"></span>
                        <br>
                     </div>
                </div>
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
                                  
                                   
                                               <input type="number"  class="form-control input-group-addon"   maxlength="3" onkeyup="javascript:validateIp('direccionIp1','descripcionIp1')" name="direccionIp1"id="sm2" value="0">
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
                 <input type="hidden" name="verifica" id="verifica" value="0">
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
                                   <input type="number" class="form-control input-group-addon"  maxlength="3" onkeyup="javascript:validateIp('direccionIpc1','descripcionIpc1')"name="direccionIpc1"id="sm2" value="0"> 
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

                                        </select> </div>
                        
                    <div class="col-xs-6">
                        <label id="examplePass">Mac/Serial</label><br> 
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
                <span id="span_error"></span>
                <center>
                    <?php
                     if($_SESSION['cliente'] == "personal"){
                    ?>
                        <button type="button" id="btn" name="btn" onclick="RegistrarServicioPersonal('controlador/registrarcliperservicio.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Registrar</button> <br>
                    
                    <?php
                     }else{
                     ?>
                        <button type="button" id="btn" name="btn" onclick="RegistrarServicioPersonal('controlador/registrarcliEmpservicio.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-share-alt"></span>   Registrar</button> <br>
                    
                          <?php
                    
                     }
                     ?>
                        <br>               
                </center>
                </div>
</form>