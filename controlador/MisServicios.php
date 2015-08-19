    <?php
include "../modelo/Datos.php";
$datosF= new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod_ser'])){
    $datosF->cod_ser=$_POST['cod_ser'];
}
$cod_ser=$datosF->cod_ser;
if(!empty($_POST['cod_inc'])){
    $datosF->inc=$_POST['cod_inc'];
}
if(!empty($_POST['con'])){
    $datosF->con=$_POST['con'];
}

$datosF->ima=1;
$datosF->num=1;
if($datosF->con == 1 ){
    $tablaincidencia="Incidencias_Personales";
    $tablaSoporte="SoportesIncidenciasPersonales";
    $tablatecnico="TecnicosInciden_Personales";
}else{
    $tablaincidencia="Incidencias_Empresariales";
    $tablaSoporte="SoportesIncidenciasEmpresas";
    $tablatecnico="TecnicosInciden_Empresariales";
} 
date_default_timezone_set('America/Bogota');
$Incidencias=$datosF->VerIncidencias($tablaincidencia,$datosF->cod_ser);
while($row=mysqli_fetch_array($Incidencias)){
     if($datosF->inc == $row['cod_inc']){
         $datosF->creador= $row['creador_inc'];
         $datosF->cod_inc=$row['cod_inc'];
         $datosF->TecnicoResponsable=$row['responsable_inc'];
         if($datosF->con == 1){
             $query2=$datosF->ServiciosClientesPersonales($datosF->cod_ser);
            while($rows=  mysqli_fetch_array($query2)){
                $datosF->tiposervicio=$rows['tiposervicio'];
                $datosF->Ubicacion=$rows['cod_ubicacion'];
            }
         }
     ?><br>
<div id="titulo-form" class="col-xs-12"><br>
    <h3>Detalles</h3>
</div>

     <?php
         if($datosF->con == 1){
         echo "<div class='col-sm-6 col-xs-12'>";
          $query=$datosF->UbicacionesClientesPersonales($datosF->Ubicacion);
            while($row=  mysqli_fetch_array($query)){
                $query2=$datosF->BD_Municipios();
                  while($rowf=mysqli_fetch_array($query2)){
                    if($datosF->Ubicacion == $rowf['cod_mun']){
                        $municipio=$rowf['nombre_mun'];
                    }
                  }
                                       
                    $datosF->cod_ubi=$row['cod_ubi'];
                 echo "<h4>Datos de Ubicacion:</h4>" ;
                 echo "<br>-".$datosF->nombreubi = $row['nombre_ubi']." - ".$datosF->direccionubi = $row['direccion_ubi']." - ".$municipio;

                  echo "<br>-".   $datosF->nombre_per_ubi = $row['nombre_per_sitio_ubi']." ".$datosF->apellido_per_ubi = $row['apellido_per_sitio_ubi'];
                   echo "<br>-".  $datosF->celular_per_ubi = $row['celular_per_sitio_ubi'];
         }
         echo '</div>';
          echo "<div class='col-sm-6 col-xs-12'>";
         
          $query=$datosF->ServiciosClientesPersonales($cod_ser);
        if(mysqli_num_rows($query) > 0){
            
            while($row=mysqli_fetch_array($query)){
                $datosF->num_contrato=$row['numcontrato_ser'];
                $tipoconex=$row['tipoconex'];
                $nodo=$row['nodo_det'];
                $antena=$row['antena_det'];
                $datosF->formato_contrato=$row['formatocontrato_ser'];
                $query2=$datosF->BD_FormatosContrato();
                 while($row=mysqli_fetch_array($query2)){
                      if($datosF->formato_contrato == $row['cod_for']){
                            $datosF->nombreF=$row['nombre_for'];     
                        }
                 }
                 $query2=$datosF->BD_TipoConexion();
                 while($rowt=mysqli_fetch_array($query2)){
                       if($tipoconex == $rowt['cod_con']){
                            $tipoc=$rowt['nombre_con'].'</option>';
                          }
                  }
                $query2=$datosF->BD_Nodo();
                while($rown=mysqli_fetch_array($query2)){
                       if($nodo == $rown['cod_nod']){
                           $nodo=$rown['nombre_nod'];
                         }
                }
              $query2=$datosF->BD_Antena();
                while($rowa=mysqli_fetch_array($query2)){
                    if($antena == $rowa['cod_ant'] ){
                        $antena=$rowa['nombre_ant'].'</option>';
                        }
                }
             
           echo "<h4>Detalles Tecnicos:</h4>" ;
                echo "-Tipo de conexion: ".$tipoc;
                echo "<br>-Velocidad Maxima: ". $velocidadmax=$row['velmax_det'];
                echo "<br>-Velocidad Minima: ". $velocidadmin=$row['velmin_det'];
                echo "<br>-Nodo: ".$nodo;
                 echo "<br>-Antena :". $antena;
                $datosF->cod_det=$row['cod_det'];
            }
        }    
         $queryb=$datosF->SelectIpBackbone($cod_ser);
                       if(mysqli_num_rows($queryb) > 0){
                           $num=1;
                           while($rowb=mysqli_fetch_array($queryb)){
                               
                              echo "<br>-Ip backbone # ".$num.": ".$rowb['direccionip_bak'];
                              echo "<br>-Descripcion: ".$rowb['descripcionip_bak'];   
                                $num=$num+1;                
                            }
                        }
                    $queryc=$datosF->SelectIpCliente($cod_ser);
                       if(mysqli_num_rows($queryc) > 0){
                           $num=1;
                            while($rowC=mysqli_fetch_array($queryc)){
                               echo "<br>-Ip Cliente # ".$num.": ". $rowC['direccionip_cli'];
                               echo "<br>-Descripcion: ". $rowC['descripcionip_cli']; 
                                $num=$num+1;     
                            }
                       }
                  $queryE=$datosF->SelectIpEquipos($cod_ser);
                       if(mysqli_num_rows($queryE) > 0){
                           $num=1;
                            while($rowE=  mysqli_fetch_array($queryE)){
                                 
                                $queryBE=$datosF->BD_Elementos();
                                 while($rowBE=mysqli_fetch_array($queryBE)){
                                      if($rowE['elemento'] ==  $rowBE['cod_ele']){
                                                echo "<br>-Elemento # ".$num.": ". $rowBE['nombre_ele'];
                                        }
                                  }    
                                 echo "<br>-Mac/Serial: ".$rowE['mac_ip'];
                                 echo "<br>-Descripcion: ".$rowE['descripcion'];
                         $num=$num+1;     
                            }
                       }
     }else{
                $queryB=$datosF->SelectIpBackboneEmp($cod_ser);
                       if(mysqli_num_rows($queryB) > 0){
                           while($rowB=mysqli_fetch_array($queryB)){
                               $rowB['direccionip_bak_emp'];
                               $rowB['descripcion_bak_emp'];            
                           }
                       }
                    $queryC=$datosF->SelectIpClienteEmp($cod_ser);
                       if(mysqli_num_rows($queryC) > 0){
                            while($rowC=  mysqli_fetch_array($queryC)){
                             $rowC['direccionip_cli_emp'];
                             $rowC['descripcionip_cli_emp']; 
                            }
                       }
                    $queryE=$datosF->SelectIpEquiposEmp($cod_ser);
                       if(mysqli_num_rows($queryE) > 0){
                            while($rowE=  mysqli_fetch_array($queryE)){
                                   $queryBD=$datosF->BD_Elementos();
                                    while($rowBD=mysqli_fetch_array($queryBD)){
                                          if($rowC['elemento_emp'] ==  $rowBD['cod_ele']){
                                                   $rowBD['nombre_ele'].'</option>';
                                           }
                                     }
                          $rowC['mac_emp'];
                          $rowC['descripcion_emp'];
                            
                            }          
                       }
         }
         
         echo "</div>";
       ?>


<div id="incidencias">
    <br>
     <div id="titulo-form" class="col-xs-12">
         
     <h3>Incidencia</h3>
         
      </div>
    <br>
    <form class="formulario1" enctype="multipart/form-data" method="post">
       <br>
        <input type="hidden" name="cod_ser" value="<?php echo $datosF->cod_ser;?>">
        <input type="hidden" name="con" value="<?php echo $datosF->con;?>">
           
        <div class="col-sm-12 col-lg-6"> 
             <div class=" visible-sm visible-xs" >
                    
                    <div class="col-xs-12 "><br>
                             <label class="col-sm-12"><span class="glyphicon glyphicon-sta"></span>Numero:</label>
                        <div class="col-sm-12">
                             <input type="numero" readonly="readonly" class="form-control float" name="numeroInci" id="numeroInci"  value="<?php echo $datosF->cod_inc; ?>">
                        </div>
                    </div>
            </div>
             <div class=" col-xs-12"><br>
                    <label class="col-lg-4 col-sm-12"> <span class="glyphicon glyphicon-user"></span>  Creador </label>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" readonly="readonly" class="form-control" name="creador_inc" id="creador_inc"  value="<?php echo $datosF->creador; ?>">
                </div>

            </div>
                 
               <div class="col-xs-12"><br>
                   <label  class="col-lg-4 col-sm-12"><span class="glyphicon glyphicon-list"></span> Servicio   Afectado</label>
                    <div class="col-lg-8 col-sm-12">
                        <select name="servicioAfectado" disabled class="form-control" id="servicioAfectado">
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
                </div>
            
                <div class="col-xs-12"><br>
                    <label  class="col-lg-4 col-sm-12">Responsable</label>
                    <div class="col-lg-8 col-sm-12">
                        <select name="TecnicoResponsable" <?php if($datosF->creador != $_SESSION['nombres']){if($_SESSION['rol'] == 1){}else{ echo 'disabled';}}?> class="form-control" id="TecnicoResponsable">
                            <option value="0">..Seleccionar..</option>
                           <?php
                                $query=$datosF->SelectTecnicos();
                                while($row=mysqli_fetch_array($query)){
                                    if($datosF->TecnicoResponsable == $row['documento_usu']){
                                        
                                        echo '<option value="'.$row['documento_usu'].'" selected>'.$row['nombre_usu'].' '.$row['apellido_usu'].'</option>';
                                    }else{
                                        echo '<option value="'.$row['documento_usu'].'">'.$row['nombre_usu'].' '.$row['apellido_usu'].'</option>';
                                    }
                                }
                                
                            ?>
                       </select>
                        <span id="tecnicoresponsable"></span>
                        <br>
                    </div>
                </div>
        </div> 
        <div class="col-xs-6 hidden-sm hidden-xs" >
                    
                    <div class="col-xs-12 float"><br>
                             <label class="col-xs-offset-4 col-xs-3"><span class="glyphicon glyphicon-sta"></span>Numero:</label>
                        <div class="col-xs-4">
                             <input type="numero" readonly="readonly" class="form-control float" name="numeroInci" id="numeroInci"  value="<?php echo $datosF->cod_inc; ?>">
                        </div>
                    </div>
        </div>
        
       
        
        <?php
         $Soportes=$datosF-> VerSoportes($tablaSoporte,$datosF->cod_inc);
         $datosF->num=mysqli_num_rows($Soportes);
         while($row=mysqli_fetch_array($Soportes)){
             
           $datosF->cod_sop=$row['cod_sop'];
           $datosF->fechaCre=$row['fechaCrear_sop'];
           $datosF->horaCre=$row['horaCrear_sop'];
           $datosF->descripcionProblem=$row['descripcion_sop'];
           $datosF->archivoCre=$row['archivoCrear_sop'];
           $datosF->fechaCerrar_sop=$row['fechaCerrar_sop'];
           $datosF->horaCerrar_sop=$row['horaCerrar_sop'];
           $datosF->solucion_sop=$row['solucion_sop'];
           $datosF->archivoCer=$row['archivoCerrar_sop'];
            
           
         ?><hr class="hrcolor df">
        <div class="col-xs-12" >
             <h3>Soporte # <?php echo $datosF->num;?></h3>
        </div>
        <input type="hidden" name="<?php if(!empty($datosF->solucion_sop)){ echo'codigosoporte';}else{echo 'codigosoporte1';}?>" value="<?php echo $datosF->cod_sop;?>">
        <div class="col-lg-6 col-sm-12" >
            <div class="col-xs-12"> <br>
                    <label  class="col-lg-4 col-sm-12"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                    <div class="col-lg-8 col-sm-12">
                        <input type="date"  readonly="readonly" class="form-control" name="fechaCre<?php echo $datosF->num;?>" id="fechaCre<?php echo $datosF->num;?>" value="<?php echo $datosF->fechaCre; ?>">
                    </div>
                 </div>
                 <div class="col-xs-12"><br>
                       <label  class="col-lg-4 col-sm-12"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                        <div class="col-lg-8 col-sm-12">
                                <input type="time" readonly="readonly"  class="form-control" name="horaCre<?php echo $datosF->num;?>" id="horaCre<?php echo $datosF->num;?>"  value="<?php echo $datosF->horaCre; ?>">
                        </div>
                </div>
            <div class="col-xs-12"><br>
                <label class="col-lg-4 col-sm-12"><span class="glyphicon glyphicon-wrench"></span> Tecnicos</label>
              <?php
                if($datosF->creador == $_SESSION['nombres']){
                echo '<div class="col-lg-8 col-sm-12 checkbox">';
                }else{
                    if($_SESSION['rol'] == 1){
                        if($datosF->fechaCerrar_sop != "0000-00-00"){
                               echo '<div class="col-lg-8 col-sm-12 checkbox disabled">';
                        }else{
                             echo '<div class="col-lg-8 col-sm-12 checkbox">';
                        }
                       
                    }else{
                    if($datosF->fechaCerrar_sop != "0000-00-00"){
                               echo '<div class="col-lg-8 col-sm-12 checkbox disabled">';
                        }else{
                             echo '<div class="col-lg-8 col-sm-12 checkbox">';
                        }
                    }
                }
                                $MisTecnicos=$datosF->SelectTecnicosInciPersonales($tablatecnico,$datosF->cod_sop);
                                  if(mysqli_num_rows($MisTecnicos) > 0){
                                      $inicie=0;
                                      $array="";
                                      while($tecnico=mysqli_fetch_array($MisTecnicos)){
                                               $query=$datosF->SelectTecnicos();
                                            while($row=mysqli_fetch_array($query)){
                                                if($tecnico['cod_usuario'] == $row['documento_usu']){
                                                    ?>
                                                    <label><input type="checkbox" name="tecnicos1[]"  disabled checked id="tecnicos" value="<?php echo $row['documento_usu']; ?>"><?php echo $row['nombre_usu'].' '.$row['apellido_usu']; ?></label><br>
                                                    <?php
                                                    $array[$inicie]=$row['documento_usu'];
                                                    $inicie=$inicie+1;
                                                }
                                               
                                            }
                                      }
                                      $query=$datosF->SelectTecnicos();
                                      while($row=mysqli_fetch_array($query)){
                                          $compara="false";
                                          for($i=0;$i < count($array);$i++){
                                              if($row['documento_usu'] == $array[$i]){
                                                  $compara="true";
                                              }
                                          }
                                         if($compara == "false"){
                                             ?>
                                    <label><input type="checkbox" name="tecnicos1[]" disabled id="tecnicos" value="<?php echo $row['documento_usu']; ?>"><?php echo $row['nombre_usu'].' '.$row['apellido_usu']; ?></label><br>
                                                   
                                            <?php
                                         }
                                      }
                                      
                                      
                                  }else{
                                        $query=$datosF->SelectTecnicos();
                                        while($row=mysqli_fetch_array($query)){
                                            ?>
                                            <label><input type="checkbox" name="tecnicos1[]" disabled id="tecnicos" value="<?php echo $row['documento_usu']; ?>"><?php echo $row['nombre_usu'].' '.$row['apellido_usu']; ?></label><br>
                                      <?php
                  }
                                  }
                               echo '</div>';
                            ?>
                
            </div>
                <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Descripcion del Problema</label>
                              <textarea  disabled name="descripcionServicio<?php echo $datosF->num;?>" id="descripcionServicio<?php echo $datosF->num;?>" class="form-control" rows="10" cols="40"><?php echo $datosF->descripcionProblem; ?></textarea>
                           <span id="descripcion<?php echo $datosF->num;?>"></span>
                        </div>
                    </div>
                 
        </div>
                <div class="col-lg-6 col-sm-12" >
                   <div class="col-xs-12"><br>
                        <label  class="col-lg-4 col-sm-12"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                       <div class="col-lg-8 col-sm-12">
                            <input type="file"  disabled   name="archivoIncidencia1" class="form-control" id="archivoIncidencia<?php echo $datosF->num;?>">
                        </div><br>
                 </div>
                  
                    <div id="verarchivo<?php echo $datosF->num;?>" class="col-lg-offset-3 col-lg-8 col-sm-12"><br><br>
                        <?php
                        $imagen=$datosF->archivoCre;
                        for($i=strlen($imagen)-1;$i >= 1;$i--){
                            if($imagen[$i] == "."){
                                $posicion=$i-strlen($imagen);
                                $posicion=$posicion+1;
                                $extension = substr($imagen,$posicion);
                                break;
                             }
                        } 
                        $extension=strtolower($extension);
                        $url="";
                        $compara=3;
                           if($extension == "jpg" or $extension == "png" or $extension == "gif" or $extension == "jpeg"  ){
                                $url=$imagen;
                                $compara=1;
                            }else{
                                if($extension == "mp4" or $extension == "avi" or $extension == "mpeg" or $extension == "mov" or $extension == "wmv" or $extension == "rm" or $extension == "flv" ){
                                    $url="vista/img/icon_mp4.jpg";
                                    $compara=2;
                                }else{
                                    if($extension == "pdf"){
                                        $url="vista/img/icon_pdf.png";
                                    }else{
                                        if($extension == "xlsx"){
                                             $url="vista/img/icon_execel.jpg";
                                        }else{
                                            if($extension == "docx"){
                                               $url="vista/img/icon_word.png";
                                            }else{
                                                if($extension == "txt"){
                                                     $url="vista/img/icon_txt.png";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        $ver=$imagen;
                          echo "<br><br><img src='".$url."' style='width:70%;heigth:170px;' class='img-thumbnail'>";
                              echo '<br><center><a onclick="VerArchivo(\''.$ver.'\',\''.$compara.'\')" id="cursor">Ver <span class="glyphicon glyphicon-eye-open"></span></a></center>';

                        ?>
                    </div>
                </div>
        <input type="hidden" name="<?php if(!empty($datosF->solucion_sop)){ echo'valorImagen';}else{echo 'valorImagen1';}?>" id="valorImagen<?php echo $datosF->num;?>" value="<?php echo $ver; ?>">
    
            <div class="col-xs-12">
               <br> <h3>Cerrar Soporte</h3>
            </div>
                
           
            <div class="col-lg-6 col-xs-12 ">
                     <div class="col-xs-12"> <br>
                        <label  class="col-lg-4 col-xs-12"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                        <div class="col-lg-8 col-xs-12">
                            <input type="date"  <?php if(!empty($datosF->solucion_sop)){echo 'disabled';}else{ echo 'readonly="readonly"'; $datosF->fechaCerrar_sop=date('Y-m-d');  }?>  class="form-control" name="<?php if(!empty($datosF->solucion_sop)){ echo'fechaCerr';}else{echo 'fechaCerr1';}?>"id="fechaCerr<?php echo $datosF->num;?>" value="<?php echo $datosF->fechaCerrar_sop; ?>">
                        </div>
                     </div>
                     <div class="col-xs-12"><br>
                           <label  class="col-lg-4 col-xs-12"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                            <div class="col-lg-8 col-xs-12">
                                    <input type="time" <?php if(!empty($datosF->solucion_sop)){echo 'disabled';}else{ echo 'readonly="readonly"';$datosF->horaCerrar_sop=date('H:i:s');}?>  class="form-control" name="<?php if(!empty($datosF->solucion_sop)){ echo'horaCerr';}else{echo 'horaCerr1';}?>" id="horaCerr<?php echo $datosF->num;?>"  value="<?php echo $datosF->horaCerrar_sop; ?>">
                            </div>
                    </div>
                 <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Solucion</label>
                              <textarea <?php if(!empty($datosF->solucion_sop)){echo 'disabled';}?>  name="<?php if(!empty($datosF->solucion_sop)){ echo'solucion';}else{echo 'solucion1';}?>" id="solucion1" class="form-control" rows="10" cols="40"><?php if(!empty($datosF->solucion_sop)){echo $datosF->solucion_sop;}else{echo "";}?></textarea>
                        <span id="<?php if(!empty($datosF->solucion_sop)){ echo'solucionF';}else{echo 'solucionF1';}?>"></span>
                     </div>
                    </div>
                
            </div>
            <div class="col-lg-6 col-xs-12 " >
                   
                    <div class="col-xs-12 "><br>
                            <label  class="col-lg-4 col-xs-12"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                           <div class="col-lg-8 col-xs-12">
                                <input type="file" <?php if(!empty($datosF->solucion_sop)){echo 'disabled';}?> onchange="Archivo('verarchivoCerr<?php echo $datosF->num;?>','controlador/ArchivoCerrar.php',<?php echo $datosF->PoscImagen=$datosF->num?>)" name="<?php if(!empty($datosF->solucion_sop)){ echo'cerrararchivoIncidencia';}else{echo 'cerrararchivoIncidencia1';}?>" class="form-control" id="cerrararchivoIncidencia<?php echo $datosF->num;?>">
                            </div><br>
                     </div>
                    <div id="verarchivoCerr<?php echo $datosF->num;?>" class="col-lg-offset-3 col-lg-8 col-xs-12"><br><br>
                       <?php
                        $imagen=$datosF->archivoCer;
                        for($i=strlen($imagen)-1;$i >= 1;$i--){
                            if($imagen[$i] == "."){
                                $posicion=$i-strlen($imagen);
                                $posicion=$posicion+1;
                                $extension = substr($imagen,$posicion);
                                break;
                             }
                        } 
                        $extension=strtolower($extension);
                        $url="";
                        $compara=3;
                           if($extension == "jpg" or $extension == "png" or $extension == "gif" or $extension == "jpeg"  ){
                                $url=$imagen;
                                $compara=1;
                            }else{
                                if($extension == "mp4" or $extension == "avi" or $extension == "mpeg" or $extension == "mov" or $extension == "wmv" or $extension == "rm" or $extension == "flv" ){
                                    $url="vista/img/icon_mp4.jpg";
                                    $compara=2;
                                }else{
                                    if($extension == "pdf"){
                                        $url="vista/img/icon_pdf.png";
                                    }else{
                                        if($extension == "xlsx"){
                                             $url="vista/img/icon_execel.jpg";
                                        }else{
                                            if($extension == "docx"){
                                               $url="vista/img/icon_word.png";
                                            }else{
                                                if($extension == "txt"){
                                                     $url="vista/img/icon_txt.png";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
             $datosF->archivoCer="";
                        $ver=$imagen;
                          echo "<br><br><img src='".$url."' style='width:70%;heigth:170px;' class='img-thumbnail'>";
                              echo '<br><center><a onclick="VerArchivo(\''.$ver.'\',\''.$compara.'\')" id="cursor">Ver <span class="glyphicon glyphicon-eye-open"></span></a></center>';

                        ?>
                         <input type="hidden" name="<?php if(!empty($datosF->solucion_sop)){ echo'valorImagen';}else{echo 'valorImagen1';}?>" id="valorImagen<?php echo $datosF->num;?>" value="<?php echo $ver; ?>">
                    </div>
                </div>
        <?php if(empty($datosF->solucion_sop)){?>
             <div class="col-xs-12"><br>
                <button type="button"  onclick="CerrarIncidencia()" class="btn btn-info float"><span class="glyphicon glyphicon-eye-close"></span>  Cerrar Soporte</button>
               <br>
            </div>
        <?php } ?>
        
        
           
  <div class="col-xs-12"><br>
            
        </div>
<?php
             
    
             $datosF->num=$datosF->num-1;
         }
          ?>

    </form>
    </div>
 
<?php    
     }
}
$_SESSION['datosF']=$datosF;
?>