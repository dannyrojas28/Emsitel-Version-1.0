<?php

include ('../modelo/Datos.php');
session_start();
$datosF = new Datos();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['codubi'])){
    $datosF->cod_ubi=$_POST['codubi'];
}
if($datosF->con == 1 ){
    $query=$datosF->UbicacionesClientesPersonales($datosF->cod_ubi);
    while($row=  mysqli_fetch_array($query)){
    $datosF->cod_ubi=$row['cod_ubi'];
    $datosF->nombreubi = $row['nombre_ubi']; 
    $datosF->direccionubi = $row['direccion_ubi'];
    $datosF->municipioubi = $row['municipio_ubi'];
    $datosF->nombre_per_ubi = $row['nombre_per_sitio_ubi'];
    $datosF->apellido_per_ubi = $row['apellido_per_sitio_ubi'];
    $datosF->telefono_per_ubi = $row['telefono_per_sitio_ubi'];
    $datosF->celular_per_ubi = $row['celular_per_sitio_ubi'];
    $datosF->email_per_ubi = $row['email_per_sitio_ubi'];
}
}else{
    $query=$datosF->UbicacionesClientesEmpresariales($datosF->cod_ubi);
    while($row=  mysqli_fetch_array($query)){
    $datosF->cod_ubi=$row['cod_ubi_emp'];
    $datosF->nombreubi = $row['nombreubi_emp']; 
    $datosF->direccionubi = $row['direccionubi_emp'];
    $datosF->municipioubi = $row['municipioubi_emp'];
    $datosF->nombre_per_ubi = $row['nombre_per_sitio_ubi'];
    $datosF->apellido_per_ubi = $row['apellido_per_sitio_ubi'];
    $datosF->telefono_per_ubi = $row['telefono_per_sitio_ubi'];
    $datosF->celular_per_ubi = $row['celular_per_sitio_ubi'];
    $datosF->email_per_ubi = $row['email_per_sitio_ubi'];
    }
}

?>
<script type="text/javascript">
    document.getElementById('regresar').innerHTML='<a  onclick="Incidencias()" class="float" id="cursor"> <span class="glyphicon glyphicon-arrow-left"> Regresar</span></a>';
</script>
<div id="ubicacion"><br>
                   <div id="titulo-form" class="col-xs-12">
                    
                        <h3>Ubicacion del servicio  <span class="glyphicon glyphicon-map-marker float"></span></h3>
                    
                      
                    </div>

                
                 <div class="form-group">
                     <br>
                    <div class="col-xs-4">
                        <h5 id="examplePass">Nombre de ubicacion</h5>
                            <input type="text" class="form-control" disabled placeholder="Nombre de ubicacion/ sede" name="nombre_ubicacion" id="nombre_ubicacion" value="<?php echo $datosF->nombreubi;?>">
                     </div>
               
                    <div class=" col-xs-5">
                        <h5 id="examplePass">Direccion</h5>
                        <input type="text" class="form-control" disabled placeholder="Direccion del Servicio" name="direccion_ubicacion" id="direccion_ubicacion" value="<?php echo $datosF->direccionubi;?>">
                    </div>
                    <div class="col-xs-3">
                         <h5 id="examplePass">Municipio</h5>
                        <select class="form-control" disabled name="municipio_ubicacion" id="municipio_ubicacion"  >
                            <option value="0">Seleccione el Municipio</option>
                            <?php
                                $query2=$datosF->BD_Municipios();
                                while($row=mysqli_fetch_array($query2)){
                                    if($datosF->municipioubi == $row['cod_mun']){
                                        echo '<option value="'.$row['cod_mun'].'" selected>'.$row['nombre_mun'].'</option>';
                                    }else{
                                        echo '<option value="'.$row['cod_mun'].'" >'.$row['nombre_mun'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        
                    </div>
                     
                </div>
               
                <div class="form-group">
                    <div class="col-sm-3">
                        <h5 id="examplePass">Persona en Sitio</h5>
                        <input type="texto" class="form-control" disabled  name="nombre_per_ubicacion"id="nombre_per_ubicacion" value="<?php echo $datosF->nombre_per_ubi." ".$datosF->apellido_per_ubi;?>">
                    </div>
                    <div class="col-sm-3">
                        <h5 id="examplePass">Telefono</h5>
                        <input type="number" class="form-control" disabled placeholder="Numero telefonico " name="telefono_per_ubicacion" id="telefono_per_ubicacion"value="<?php echo $datosF->telefono_per_ubi?>">
                        
                    </div>
                    <div class="col-sm-3">
                        
                        <h5 id="examplePass">Celular</h5>
                        <input type="number" class="form-control" disabled placeholder="Numero Celular" name="celular_per_ubicacion" id="celular_per_ubicacion"value="<?php echo $datosF->celular_per_ubi?>">
                        <span id="span_celular"></span>
                    </div>
                    <div class="col-sm-3">
                        <h5 id="examplePass">Email</h5>
                    <input type="email" class="form-control" disabled placeholder="Correo del cliente" name="email_per_ubicacion" id="email_per_ubicacion"value="<?php echo $datosF->email_per_ubi?>">   
                     <br> 
                    </div>
                </div>
     
</div>
<?php
if(!empty($_POST['codser'])){
    $datosF->cod_ser= $_POST['codser'];
}
$cod_ser=$datosF->cod_ser;
if($datosF->con == 1){
    $query=$datosF->ServiciosClientesPersonales($cod_ser);
    if(mysqli_num_rows($query) > 0){
       
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
    }
}else{
        $query=$datosF->ServiciosClientesEmpresariales($cod_ser);
            if(mysqli_num_rows($query) > 0){
                while($row=  mysqli_fetch_array($query)){
                    $datosF->tiposervicio=$row['tipo_servicio_emp'];
                    $datosF->estadoservicio=$row['estado_servicio_emp'];
                    $datosF->formato_contrato=$row['formatocontrato_emp'];
                    $datosF->num_contrato=$row['numcontrato_emp'];
                    $datosF->fechaini=$row['fechainicio_emp'];
                    $datosF->fechafin=$row['fechafin_emp'];
                    $datosF->asesorcomercial=$row['asesorcomercial_emp'];
                    $datosF->descripcion_contrato=$row['descripcioncomercial_emp'];
                    $estadoservicio=$row['tipocone_emp'];
                    $velocidadmax=$row['velmax_emp'];
                    $velocidadmin=$row['velmin_emp'];
                    $nodo=$row['nodo_emp'];
                    $antena=$row['antena_emp'];
                    $datosF->cod_det=$row['cod_det_emp'];

                }
            }
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
                         <h5 id="examplePass">Tipo de Servicio</h5>
                        <select class="form-control" disabled  onclick="TipoServicio()"id="tiposervicio" name="tiposervicio"> 
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
                    </div>
                     
                    <div class="col-sm-6 col-xs-12"><br>
                         <h5 id="examplePass">Estado del Servicio</h5>
                        <select class="form-control" disabled id="estadoservicio" name="estadoservicio">
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
                    </div>
                  </div>
                <div class="form-group">  
                     <div class="col-sm-6 col-xs-12">
                        <h5 id="examplePass">Formato de Contrato</h5>
                        <select class="form-control" disabled id="formato_contrato" name="formato_contrato">
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
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <h5 id="examplePass">Nº de Contrato</h5>
                        <input type="number" disabled class="form-control" placeholder="Nº Contrato" name="num_contrato" id="num_contrato" value="<?php echo $datosF->num_contrato; ?>">
                       
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <h5 id="examplePass">Fecha De Inicio</h5>
                        <input type="date" class="form-control"  disabled id="fecha_inicio" name="fecha_inicio" value="<?php echo $datosF->fechaini;?>">
                       
                    </div>
               
                    <div class="col-sm-6 col-xs-12">
                        <h5 id="examplePass">Fecha De Fin</h5>
                        <input type="date" class="form-control"  disabled id="fecha_fin" name="fecha_fin" value="<?php echo $datosF->fechafin;?>">
                        
                    </div>
                </div>
                
                 <div class="col-xs-12">
                         <h5 id="examplePass">Asesor Comercial</h5>
                        <select class="form-control" id="asesorcomercial" disabled name="asesorcomercial">
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
                    </div>
                <input type="hidden" id="asesorcomercials" value="">
                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <h5 id="examplePass">Descripcion Comercial</h5>
                        <input type="text" class="form-control" disabled  id="descripcion_contrato" name="descripcion_contrato" value="<?php echo $datosF->descripcion_contrato;?>">
                      
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
                        <h5 id="examplePass">Tipo de Conexion</h5>
                           <select disabled class="form-control" name="tipoconexion" id="tipoconexion">
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
                     </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        <h5 id="examplePass">Velocidad Maxima</h5>
                        <input type="number" disabled class="form-control" placeholder="Velocidad Maxima" id="velocidadmax" name="velocidadmax" value="<?php echo $velocidadmax;?>" >

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-xs-12">
                        
                        <h5 id="examplePass">Velocidad Minima</h5>
                        <input type="number" disabled class="form-control" placeholder="Velocidad Minima" id="velocidadmin" name="velocidadmin" value="<?php echo $velocidadmin;?>">

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-6">
                        <h5 id="examplePass">Nodo</h5>
                        <select disabled class="form-control" id="nodo" name="nodo">
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
                        <br>
                     </div>
                    
                    <div class="col-xs-12 col-sm-6">
                        <h5 id="examplePass">Antena</h5>
                        <select disabled class="form-control" id="antena" name="antena" >
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
                     </div>
                </div>
                <?php
                 if($datosF->con == 1){
                 ?>
                <div class="col-xs-12 ip">
                    <h5 id="examplePass">IP BACKBONE</h5>
                </div>
                <?php
                    $query2=$datosF->SelectIpBackbone($cod_ser);
    
                       if(mysqli_num_rows($query2) > 0){
                           $cod=1;
                           while($rowc=mysqli_fetch_array($query2)){
                           ?>
                                      <div class="form-group">
                                         <div class="col-xs-7">
                                                <h5 id="examplePass">Direccion Ip <?php echo $cod; ?></h5>
                                                  <div class="input-group">
                                                                   <input type="hidden" name="cod_bak<?php echo $cod; ?>" value="<?php echo $rowc['cod_bak']; ?>">
                                                                        <select disabled id="sm"  class="form-control"  name="rangoipB<?php echo $cod; ?>">
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
                                                                <input type="number" disabled class="form-control input-group-addon"   maxlength='3' onkeyup="javascript:validateIp('direccionIp<?php echo $cod; ?>','descripcionIp<?php echo $cod; ?>')" name="direccionIp<?php echo $cod; ?>"id="sm2" value="<?php echo $num_ip1;?>">
                                                        </div>
                                                     </div>  
                           
                          
                                                          <div class="col-xs-5">
                                                                <h5 id="examplePass">Descripcion</h5>
                                                                <input disabled type="text" class="form-control"  placeholder="Descripcion Ip 1" name="descripcionIp<?php echo $cod; ?>"id="descripcionIp<?php echo $cod; ?>"  value="<?php echo $rowc['descripcionip_bak']; ?>" >                                                     
                                                         </div>
                                                  </div>
                                                                            
                              <?php             
                                $cod=$cod+1;
                                           }
                                       }
                                ?>
                
                <div id="otras_ipx">


                </div>
                
                 <div class="col-xs-12 ip"><br>
                      <h5 id="examplePass">IP CLIENTE</h5>
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
                                         <h5 id="examplePass">Direccion Ip <?php echo $codc;?></h5>
                                          <div class="input-group">
                                               <select  disabled id="sm"  class="form-control"  name="rangoipC<?php echo $codc; ?>">
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
                                             <input type="number" disabled  class="form-control input-group-addon"   maxlength="3" onkeyup="javascript:validateIp('direccionIpc<?php echo $codc; ?>')" name="direccionIpc<?php echo $codc; ?>"id="sm2" value="<?php echo $num_ip; ?>">
                                       </div>
                                         </div>
                                    <div class="col-xs-5">
                                        <h5 id="examplePass">Descripcion</h5>
                                        <input type="text" disabled class="form-control" placeholder="Descripcion Ip 1" name="descripcionIpc<?php echo $codc;?>"id="descripcionIpc<?php echo $codc;?>" value="<?php echo $rowc['descripcionip_cli']; ?>" >
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
                    <h5 id="examplePass">Equipos</h5>
                </div>
                <?php $query2=$datosF->SelectIpEquipos($cod_ser);
                       if(mysqli_num_rows($query2) > 0){
                           $code=1;
                            while($rowc=  mysqli_fetch_array($query2)){
                                
                                ?>
                          <div class="form-group">  <br>
                               <div class="col-xs-6">
                                   <h5 id="examplePass">Elemento <?php echo $code;?></h5>
                                   <input type="hidden" name="cod_equ<?php echo $code;?>" value="<?php echo $row['cod_dir'];?>">
                                     <select  id="elementoE" disabled  class="form-control"  name="elementoE<?php echo $code;?>">
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
                                <h5 id="examplePass">Direccion Mac/Serial</h5>
                                    <input type="text" class="form-control"  disabled name="direccionmac<?php echo $code;?>"id="direccioncmac<?php echo $code;?>" value="<?php echo $rowc['mac_ip'];?>"> 
                              
                            </div>


                            <div class="col-xs-12 ">
                                <h5 id="examplePass">Descripcion</h5>
                                <input type="text" class="form-control" disabled placeholder="descripcion serial" id="descripcionserial<?php echo $code;?>" name="descripcionserial<?php echo $code;?>" value="<?php echo $rowc['descripcion'];?>">
                               
                             </div>
                        </div>
                     
                 <?php
                 $code=$code+1;
                            }
                       }
                 }else{
                     ?>
                 <div class="col-xs-12 ip">
                    <h5 id="examplePass">IP BACKBONE</h5>
                </div>
                <?php
                    $query2=$datosF->SelectIpBackboneEmp($cod_ser);
                       if(mysqli_num_rows($query2) > 0){
                           $cod=1;
                           while($rowc=mysqli_fetch_array($query2)){
                               
                               ?>
                                     <div class="form-group">
                                         <div class="col-xs-7">
                                                <h5 id="examplePass">Direccion Ip <?php echo $cod; ?></h5>
                                                  <div class="input-group">
                                                  <input type="hidden" name="cod_bak<?php echo $cod; ?>" value="<?php echo $rowc['cod_bak_emp']; ?>">
                                                  <select  id="sm" disabled class="form-control"  name="rangoipB<?php echo $cod; ?>">
                                                                            <option value="0">..Rango Ip..</option>
                                                                            <?php
                                                           $palabra=$rowc['direccionip_bak_emp'];
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
                                                                <input type="number"   disabled class="form-control input-group-addon"   maxlength='3' onkeyup="javascript:validateIp('direccionIp<?php echo $cod; ?>','descripcionIp<?php echo $cod; ?>')" name="direccionIp<?php echo $cod; ?>"id="sm2" value="<?php echo $num_ip1;?>">
                                                        </div>
                                                     </div>  
                           
                                                          <div class="col-xs-5">
                                                                <h5  id="examplePass">Descripcion</h5 >
                                                                <input type="text"  disabled class="form-control"  placeholder="Descripcion Ip 1" name="descripcionIp<?php echo $cod; ?>"id="descripcionIp<?php echo $cod; ?>"  value="<?php echo $rowc['descripcion_bak_emp']; ?>" >
                                                               
                                                         </div>
                                                  </div>                   
                             <?php
                             $cod=$cod+1;
                           }
                       }
                ?>
                <br>
                 <div class="col-xs-12 ip">
                     <h5 id="examplePass">IP CLIENTE</h5>
                </div>
                   <?php
                    $query2=$datosF->SelectIpClienteEmp($cod_ser);
                 
                       if(mysqli_num_rows($query2) > 0){
                           $codc=1;
                           $sum=1;
                            while($rowc=  mysqli_fetch_array($query2)){
                               
                                ?>
                                   <div class="form-group"><br>
                                    <div class="col-xs-7">
                                         <input type="hidden" name="cod_cli<?php echo $codc; ?>" value="<?php echo $rowc['cod_cli_emp']; ?>">
                                         <h5  id="examplePass">Direccion Ip <?php echo $codc;?></h5 >
                                          <div class="input-group">
                                               <select  disabled id="sm"  class="form-control"  name="rangoipC<?php echo $codc; ?>">
                                                  <option value="0">..Rango Ip..</option>
                                                  <?php
                                                           $palabra=$rowc['direccionip_cli_emp'];
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
                                             <input type="number"  disabled  class="form-control input-group-addon"   maxlength='3' onkeyup="javascript:validateIp('direccionIpc<?php echo $codc; ?>','descripcionIpc<?php echo $codc; ?>')" name="direccionIpc<?php echo $codc; ?>"id="sm2" value="<?php echo $num_ip; ?>">
                                       </div>
                                         </div>
                                    
                                    <div class="col-xs-5">
                                        <h5  id="examplePass">Descripcion</h5 >
                                        <input type="text"  disabled class="form-control" placeholder="Descripcion Ip 1" name="descripcionIpc<?php echo $codc; ?>"id="descripcionIpc<?php echo $codc; ?>" value="<?php echo $rowc['descripcionip_cli_emp']; ?>">
                                       
                                    </div>
                                <br>
                             </div>
                   <?php
                   $codc=$codc+1;
                            }
                       }
                  ?>
                <div class="col-xs-12 ip"> <br>
                    <h5 id="examplePass">Equipos</h5>
                </div>
                <?php
                    $query2=$datosF->SelectIpEquiposEmp($cod_ser);
                       if(mysqli_num_rows($query2) > 0){
                           $code=1;
                            while($rowc=  mysqli_fetch_array($query2)){
                                
                                ?>
                                    
                          <div class="form-group">  <br>
                                <div class="col-xs-6">
                                    <input type="hidden" name="cod_equ<?php echo $code; ?>" value="<?php echo $rowc['cod_dir_emp']; ?>">
                                    <h5  id="examplePass">Elemento <?php echo $code;?></h5 >
                                     <select  id="elementoE"  disabled  class="form-control"  name="elementoE<?php echo $code;?>">
                                                    <option value="0">Seleccione el Rango</option>
                                                    <?php
                                                $query=$datosF->BD_Elementos();
                                                while($row=mysqli_fetch_array($query)){
                                                    if($row['cod_ele'] != 0){
                                                        if($rowc['elemento_emp'] ==  $row['cod_ele']){
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
                                <h5  id="examplePass">Direccion Mac/Serial</h5>
                                    <input type="text" disabled class="form-control"  name="direccionmac<?php echo $code;?>"id="direccioncmac<?php echo $code;?>" value="<?php echo $rowc['mac_emp'];?>"> 
                                <br>
                            </div>


                            <div class="col-xs-12 ">
                                <h5 id="examplePass">Descripcion</h5 >
                                <input type="text" class="form-control" disabled placeholder="descripcion serial" id="descripcionserial<?php echo $code;?>" name="descripcionserial<?php echo $code;?>" value="<?php echo $rowc['descripcion_emp'];?>">
                                
                             </div>
                        </div>
                 
                 
                 <?php
                 }
                       }
                 }
                 ?></div>
                
                
</form>
<div class="col-xs-12">
<?php
date_default_timezone_set('America/Bogota');

$fecha=date('Y-m-d');
$hora=date('H:i:s');
$creador= $_SESSION['nombres'];
$numero=2;
?><br>
     <div id="titulo-form" class="col-xs-12">
          <a  onclick="MostrarIncidencias(<?php echo $datosF->cod_ser;?>,<?php echo $datosF->cod_ubi;?>)" class="float" id="cursor"> <span class="glyphicon glyphicon-refresh"></span></a>
                    <h3>Incidencias</h3>
      </div>
    <br>
    <form name="formulario5" enctype="multipart/form-data" method="post">
       <br>
            <div class=" col-xs-6"><br>
                    <label class="col-xs-4"> <span class="glyphicon glyphicon-user"></span>  Creador </label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="creadorTicket" id="creadorTicket" disabled value="<?php echo $creador; ?>">
                </div>

            </div>
            <div class="col-xs-offset-2 col-xs-4"><br>
                     <label class="col-xs-5"><span class="glyphicon glyphicon-star"></span>Numero:</label>
                <div class="col-xs-6">
                     <input type="numero" disabled="" class="form-control float" name="numeroInci" id="numeroInci"  value="<?php echo $numero; ?>">
                </div>
            </div>
            <div class="col-xs-6"> <br>
                    <label  class="col-xs-4"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                    <div class="col-xs-8">
                        <input type="date" disabled="" class="form-control" name="fechaInci" id="fechaInci" value="<?php echo $fecha; ?>">
                    </div>
            </div>
        <div class="col-xs-12">
        </div>
         <div class="col-xs-6"><br>
               <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                <div class="col-xs-8">
                        <input type="time" class="form-control" name="creadorTicket" id="creadorTicket" disabled value="<?php echo $hora; ?>">
                </div>
        </div>
        
        <div class="col-xs-12">
        </div>
            <div class="col-xs-6"><br>
                <label  class="col-xs-4"><span class="glyphicon glyphicon-wrench"></span>  Tecnicos</label>
                <div class="col-xs-8">
                    <select name="Tecnicos" class="form-control" id="Tecnicos">
                        <option value="0">..Seleccionar...</option>
                        <option value="1">Juan Jose</option>
                        <option value="2">Carlos Villamizar</option>
                   </select>
                </div>
            </div>
        
        <div class="col-xs-12">
        </div>
            <div class="col-xs-6"><br>
                <label  class="col-xs-4"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
               <div class="col-xs-8">
                    <input type="file" onchange="Archivo()" name="archivoIncidencia" class="form-control" id="archivoIncidencia">
                </div>
            </div>
        <div class="col-xs-6" id="Verarchivo">
            
        </div>
    </form>
    
        <div class="col-xs-12"><br>
        </div>
</div>
 
               

<?php

$_SESSION['datosF']=$datosF;?>


    