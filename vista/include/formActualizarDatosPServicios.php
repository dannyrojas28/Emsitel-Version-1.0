<?php

include ('../../modelo/Datos.php');
session_start();
$datosF = new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
$cod_ser= $_POST['cod_ser'];
$datosF->cod_ser=$cod_ser;
$query=$datosF->ServiciosClientesPersonales($cod_ser);
if(mysqli_num_rows($query) == 0){
    echo "verifique que este servicio tiene asociadas direcciones ip en la base de datos";
}else{
    while($row=  mysqli_fetch_array($query)){
        $datosF->tiposervicio=$row['tiposervicio'];
        $datosF->estadoservicio=$row['estadoservicio'];
        $datosF->formato_contrato=$row['formatocontrato_ser'];
        $datosF->num_contrato=$row['numcontrato_ser'];
        $datosF->fechaini=$row['fechainicio_ser'];
        $datosF->fechafin=$row['fechafin_ser'];
        $datosF->asesorcomercial=$row['asesorcomercial_ser'];
        $datosF->descripcion_contrato=$row['descripcomercial_ser'];
        $estadoservicio=$row['tipoconex'];
        $velocidadmax=$row['velmax_det'];
        $velocidadmin=$row['velmin_det'];
        $nodo=$row['nodo_det'];
        $antena=$row['antena_det'];
        $datosF->cod_det=$row['cod_det'];
        
    }

    ?>

<script type="text/javascript">
    document.getElementById('num_contrato').focus();
    
</script>
    

<form name="formulario2" enctype="multipart/form-data">
   
    <div class="col-xs-6">
     <br>
                    <div id="titulo-form" class="col-xs-12">
                    
                    <h3>Tipo del servicio</h3>
                    </div>
                
                
                <div class="form-group">   
                    <div class="col-sm-6 col-xs-12"><br>
                         <label id="examplePass">Tipo de Servicio</label>
                        <select class="form-control"   onclick="TipoServicio()"id="tiposervicio" name="tiposervicio"> 
                            <?php
                                $query=$datosF->BD_TiposServicio();
                                while($row=mysqli_fetch_array($query)){
                                    if($datosF->tiposervicio == $row['cod_tp']){
                                    echo '<option value="'.$row['cod_tp'].'"selected>'.$row['nombre_tp'].'</option>';
                                    }else{
                                         echo '<option value="'.$row['cod_tp'].'" >'.$row['nombre_tp'].'</option>';
                                    }
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
                                  if($datosF->estadoservicio == $row['cod_est']){
                                    echo '<option value="'.$row['cod_est'].'" selected>'.$row['nombre_est'].'</option>';
                                    }else{
                                        echo '<option value="'.$row['cod_est'].'" >'.$row['nombre_est'].'</option>';
                                    }   
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
                                $query2=$datosF->BD_FormatosContrato();
                                while($row=mysqli_fetch_array($query2)){
                                    if($datosF->formato_contrato == $row['cod_for']){
                                         echo '<option value="'.$row['cod_for'].'" selected>'.$row['nombre_for'].'</option>';
                                     }else{
                                         echo '<option value="'.$row['cod_for'].'">'.$row['nombre_for'].'</option>';
                                     }
                                }
                            ?>
                        </select>
                        <span id="span_formato"></span>
                    </div>
                    <div class="col-sm-6 col-xs-12"><br>
                        <label id="examplePass">Nº de Contrato</label>
                        <input type="number" onkeyup="NumeroContrato()" class="form-control" placeholder="Nº Contrato" name="num_contrato" id="num_contrato" value="<?php echo $datosF->num_contrato; ?>">
                        <span id="span_num"></span><br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Fecha De Inicio</label>
                        <input type="date" class="form-control"  id="fecha_inicio" name="fecha_inicio" value="<?php echo $datosF->fechaini;?>">
                        <span id="span_fechai"></span>
                        
                    </div>
               
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Fecha De Fin</label>
                        <input type="date" class="form-control"  id="fecha_fin" name="fecha_fin" value="<?php echo $datosF->fechafin;?>">
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
                                    if($datosF->asesorcomercial == $row['cod_ase']){
                                        echo '<option value="'.$row['cod_ase'].'" selected>'.$row['nombre_ase']." ".$row['apellido_ase'].'</option>';
                                     }else{
                                         echo '<option value="'.$row['cod_ase'].'">'.$row['nombre_ase']." ".$row['apellido_ase'].'</option>';
                                    
                                     }
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
                                                                             debido al grado de personalización y detalle que presentan algunas soluciones solicitadas por los clientes." id="descripcion_contrato" name="descripcion_contrato" value="<?php echo $datosF->descripcion_contrato;?>">
                        <span id="span_telefono"></span><br>
                    </div>
                </div>
                   
                    
    </div>
        
             <div class="col-xs-6">
                     <br>
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Detalles Tecnicos</h3>
                    </div>
               
     
               
                    
   
                 <div class="form-group">
                     
                    <div class="col-xs-12 "><br>
                        <label id="examplePass">Tipo de Conexion</label>
                           <select class="form-control" name="tipoconexion" id="tipoconexion">
                            <option value="0">Seleccione el Tipo</option>
                            <?php
                                $query2=$datosF->BD_TipoConexion();
                                while($row=mysqli_fetch_array($query2)){
                                    if($estadoservicio == $row['cod_con']){
                                    echo '<option value="'.$row['cod_con'].'" selected>'.$row['nombre_con'].'</option>';
                                     }else{
                                          echo '<option value="'.$row['cod_con'].'" >'.$row['nombre_con'].'</option>';
                                     }
                                }
                            ?>
                            
                        </select>
                        <span id="span_tipoconex"></span><br>
                     </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <label id="examplePass">Velocidad Maxima</label>
                        <input type="number" class="form-control" placeholder="Velocidad Maxima" id="velocidadmax" name="velocidadmax" value="<?php echo $velocidadmax;?>" >
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <label id="examplePass">Velocidad Minima</label>
                        <input type="number" class="form-control" placeholder="Velocidad Minima" id="velocidadmin" name="velocidadmin" value="<?php echo $velocidadmin;?>">
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
                                       if($nodo == $row['cod_nod']){
                                            echo '<option value="'.$row['cod_nod'].'" selected>'.$row['nombre_nod'].'</option>';
                                        }
                                     else{
                                         echo '<option value="'.$row['cod_nod'].'">'.$row['nombre_nod'].'</option>';
                                     }
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
                                        if($antena == $row['cod_ant'] ){
                                               echo '<option value="'.$row['cod_ant'].'" selected>'.$row['nombre_ant'].'</option>';
                                        }else{
                                            echo '<option value="'.$row['cod_ant'].'">'.$row['nombre_ant'].'</option>';
                                        }
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
                <?php
                    $query2=$datosF->SelectIpBackbone($cod_ser);
    
                       if(mysqli_num_rows($query2) > 0){
                           $cod=1;
                           while($rowc=mysqli_fetch_array($query2)){
                           ?>
                                      <div class="form-group">
                                         <div class="col-xs-7">
                                                <label id="examplePass">Direccion Ip <?php echo $cod; ?></label>
                                                  <div class="input-group">
                                                                   <input type="hidden" name="cod_bak<?php echo $cod; ?>" value="<?php echo $rowc['cod_bak']; ?>">
                                                                        <select  id="sm"  class="form-control"  name="rangoipB<?php echo $cod; ?>">
                                                                            <option value="0">..Rango Ip..</option>
                                                                            <?php
                                                           $palabra=$rowc['direccionip_bak'];
                                                            $rangoip=0;
                                                            $num_ip1=0;
                                                             if($palabra != 0){
                                                                for($i=strlen($palabra)-1;$i >= 1;$i--){
                                                                    if($palabra[$i] == "."){
                                                                      $rangoip = substr($palabra,0,$i+1);
                                                                        
                                                                         $posicion=$i-strlen($palabra);
                                                                            $posicion=$posicion+1;
                                                                            $num_ip1 = substr($palabra,$posicion);
                                                                        break;


                                                                        }
                                                                    }
                                                             }
                                                               $query=$datosF->BD_IpBakbone();
                                                                    while($row=mysqli_fetch_array($query)){
                                                                        if($row['cod_ipb'] != 0){
                                                                            if($rangoip == $row['formato_ipb']){ 
                                                                               echo '<option value="'.$row['formato_ipb'].'"selected>'.$row['formato_ipb'].'</option>';
                                                                         }else{
                                                                                echo '<option value="'.$row['formato_ipb'].'">'.$row['formato_ipb'].'</option>';
                                                                        
                                                                            }
                                                                      }  
                                                                    }
                                                                      ?>
                                                            </select>
                                                                <input type="number"  class="form-control input-group-addon"  max="255" maxlength='3' onkeyup="javascript:validateIp('direccionIp<?php echo $cod; ?>','descripcionIp<?php echo $cod; ?>')" name="direccionIp<?php echo $cod; ?>"id="sm2" value="<?php echo $num_ip1;?>">
                                                        </div>
                                                     </div>  
                           
                          
                                                          <div class="col-xs-5">
                                                                <label id="examplePass">Descripcion</label><br>
                                                                <input type="text" class="form-control"  placeholder="Descripcion Ip 1" name="descripcionIp<?php echo $cod; ?>"id="descripcionIp<?php echo $cod; ?>"  value="<?php echo $rowc['descripcionip_bak']; ?>" >
                                                                <br>
                                                         </div>
                                                  </div>
                                                                            
                              <?php             
                                $cod=$cod+1;
                                           }
                                       }
                                ?>
                
                <div id="otras_ipx">


                </div>
                
                 <div class="col-xs-12 ip">
                     <a  onclick="AñadirIpCliente()" class="float" id="cursor"> <span class="glyphicon glyphicon-plus-sign"></span></a>
                      <label id="examplePass">IP CLIENTE</label>
                </div>
                   <?php
                    $query2=$datosF->SelectIpCliente($cod_ser);
                 
                       if(mysqli_num_rows($query2) > 0){
                           $codc=1;
                           $sum=1;
                            while($rowc=mysqli_fetch_array($query2)){
                               
                                ?>
                               <div class="form-group"><br>
                                    <div class="col-xs-7">
                                         <input type="hidden" name="cod_cli<?php echo $codc; ?>" value="<?php echo $rowc['cod_cli']; ?>">
                                         <label id="examplePass">Direccion Ip <?php echo $codc;?></label>
                                          <div class="input-group">
                                               <select  id="sm"  class="form-control"  name="rangoipC<?php echo $codc; ?>">
                                                  <option value="0">..Rango Ip..</option>
                                                  <?php
                                                           $palabra=$rowc['direccionip_cli'];
                                                             $rangoip=0;
                                                            $num_ip=0;
                                                             if($palabra != 0){
                                                                for($i=strlen($palabra)-1;$i >= 1;$i--){
                                                                    if($palabra[$i] == "."){
                                                                      $rangoip = substr($palabra,0,$i+1);
                                                                        
                                                                         $posicion=$i-strlen($palabra);
                                                                            $posicion=$posicion+1;
                                                                            $num_ip = substr($palabra,$posicion);
                                                                        break;


                                                                        }
                                                                    }
                                                             }
                                                               $query=$datosF->BD_IpCliente();
                                                             while($row=mysqli_fetch_array($query)){
                                                              if($row['cod_ipC'] != 0){
                                                                if($rangoip == $row['formato_ipC']){
                                                                 echo '<option value="'.$row['formato_ipC'].'"selected>'.$row['formato_ipC'].'</option>';
                                                                        
                                                       
                                                                 }else{
                                                                    echo '<option value="'.$row['formato_ipC'].'"select>'.$row['formato_ipC'].'</option>';
                                                                        
                                                                
                                                             }
                                                           }
                                                          }  
                                                       ?>
                                             </select>
                                             <input type="number"  class="form-control input-group-addon"   maxlength="3" onkeyup="javascript:validateIp('direccionIpc<?php echo $codc; ?>')" name="direccionIpc<?php echo $codc; ?>"id="sm2" value="<?php echo $num_ip; ?>">
                                       </div>
                                         </div>
                                    <div class="col-xs-5">
                                        <label id="examplePass">Descripcion</label>
                                        <input type="text" class="form-control" placeholder="Descripcion Ip 1" name="descripcionIpc<?php echo $codc;?>"id="descripcionIpc<?php echo $codc;?>" value="<?php echo $rowc['descripcionip_cli']; ?>" >
                                        <br>
                                    </div>
                                <br>
                             </div>
                   <?php
                   $codc=$codc+1;
                            }
                       }
                  ?>
                
                
                <div id="otras_ipC">

                </div>
                <div class="col-xs-12 ip">
                    
                     <a  onclick="AñadirIpEquipo()" class="float" id="cursor"> <span class="glyphicon glyphicon-plus-sign"></span></a>
                    <label id="examplePass">Equipos</label>
                </div>
                <?php $query2=$datosF->SelectIpEquipos($cod_ser);
                       if(mysqli_num_rows($query2) > 0){
                           $code=1;
                            while($rowc=  mysqli_fetch_array($query2)){
                                
                                ?>
                          <div class="form-group">  <br>
                               <div class="col-xs-6">
                                   <label id="examplePass">Elemento <?php echo $code;?></label><br>
                                   <input type="hidden" name="cod_equ<?php echo $code;?>" value="<?php echo $row['cod_dir'];?>">
                                     <select  id="elementoE"  class="form-control"  name="elementoE<?php echo $code;?>">
                                                    <option value="0">Seleccione el Rango</option>
                                                    <?php
                                                $query=$datosF->BD_Elementos();
                                                while($row=mysqli_fetch_array($query)){
                                                    if($row['cod_ele'] != 0){
                                                        if($rowc['elemento'] ==  $row['cod_ele']){
                                                            echo '<option value="'.$row['cod_ele'].'" selected>'.$row['nombre_ele'].'</option>';
                                                        }else{
                                                             echo '<option value="'.$row['cod_ele'].'">'.$row['nombre_ele'].'</option>';   
                                                        }
                                                    }
                                                }
                                            ?>
                                   </select> 
                             </div>

                            <div class="col-xs-6">
                                <label id="examplePass">Direccion Mac/Serial</label><br> 
                                    <input type="text" class="form-control"  name="direccionmac<?php echo $code;?>"id="direccioncmac<?php echo $code;?>" value="<?php echo $rowc['mac_ip'];?>"> 
                                <br>
                            </div>


                            <div class="col-xs-12 ">
                                <label id="examplePass">Descripcion</label>
                                <input type="text" class="form-control" placeholder="descripcion serial" id="descripcionserial<?php echo $code;?>" name="descripcionserial<?php echo $code;?>" value="<?php echo $rowc['descripcion'];?>">
                                <br>
                             </div>
                        </div>
                     
                 <?php
                 $code=$code+1;
                            }
                       }
                  ?>
                <input type="hidden" name="Backbone"id="Backbone" value="<?php echo $cod-1;?>">
                <input type="hidden" name="Cliente" id="Cliente" value="<?php echo $codc-1;?>">
                <input type="hidden" name="Equipo" id="Equipo" value="<?php echo $code-1;?>">
                <input type="hidden" name="comparadoripb"id="comparadoripb" value="1">
                <input type="hidden" name="comparadoripc" id="comparadoripc" value="1">
                <input type="hidden" name="comparadoripEq" id="comparadoripEq" value="1">
                <input type="hidden" name="verifica" id="verifica" value="1">
                <input type="hidden" name="verificaC" id="verificaC" value="1">
                <input type="hidden" name="verificaE" id="verificaE" value="1">
                <div id="otras_ipEq">
                    
                </div>
                <div class="col-xs-12">
                <span id="span_error"></span>
                  </div>
                 </div>
                 <div class="col-xs-12">
                     <center>
                     <button type="button" id="btn" name="btn" onclick="RegistrarCliPerServicioUbicacion('controlador/actualizarserviciospersonales.php')" class="btn btn-primary"> <span class="glyphicon glyphicon-refresh"></span>   Actualizar</button> <br>
                    <br>               
                </center>
                 </div>
                
                
</form>
<?php

}
$_SESSION['datosF']=$datosF;?>