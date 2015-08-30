    <?php
include "../../modelo/Datos.php";
$datosF= new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod_ser'])){
$datosF->cod_ser=$_POST['cod_ser'];
}
if(!empty($_POST['con'])){
    $datosF->con=$_POST['con'];
}
date_default_timezone_set('America/Bogota');
$datosF->creador= $_SESSION['nombres'];
$datosF->cod_inc=1;
$datosF->fechaCre=date('Y-m-d'); 
$datosF->horaCre=date('H:i:s');
$datosF->descripcionProblem="";
$datosF->fechaCerr="";
$datosF->horaCerr="";
$datosF->archivoCre="";
$datosF->solucion="";
$misIncidencias="true";
$datosF->TecnicoResponsable=0;
if(!empty($_POST['pag'])){
    $datosF->pagina=$_POST['pag'];
}
$revPag=1;
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
$Incidencias=$datosF->VerIncidencias($tablaincidencia,$datosF->cod_ser);
$numerodepaginas=mysqli_num_rows($Incidencias);
 while($row=mysqli_fetch_array($Incidencias)){
     
     if($revPag == $datosF->pagina){
         $datosF->creador= $row['creador_inc'];
         $datosF->cod_inc=$row['cod_inc'];
         $datosF->TecnicoResponsable=$row['responsable_inc'];
         $datosF->fechaInc=$row['fecha_inc'];
         $datosF->horaInc=$row['hora_inc'];
      
     ?>
<div id="incidencias">
    <script type="text/javascript">
        document.getElementById('creador_inc').focus();
    </script>
    <br>
     <div id="titulo-form" class="col-xs-12">
         
      <a  onclick="MostrarIncidencias(<?php echo $datosF->cod_ser;?>,<?php echo $datosF->cod_ubi;?>,<?php echo $actualiza=1;?>)" class="float" id="cursor">   <span class="glyphicon glyphicon-refresh"></span></a> 
         <a  onclick="MostrarIncidencias(<?php echo $datosF->cod_ser;?>,<?php echo $datosF->cod_ubi;?>,<?php echo $nueva=2;?>)" class="float" id="cursor" style="text-decoration:none"> <span class="glyphicon glyphicon-plus-sign">    </span> Nueva Incidencia   &nbsp; &nbsp; &nbsp; </a> 
                    <h3>Incidencias</h3>
          <?php 
            if($datosF->pagina != $numerodepaginas){
          ?>
                    <a  onclick="MisIncidencias(<?php echo $paginas=$datosF->pagina+1;?>)" class="float" style="text-decoration:none" id="cursor">  Siguiente<span class="glyphicon glyphicon-chevron-right"> </span> </a> 
         <?php }
         echo " <p class='float'>&nbsp; &nbsp; &nbsp; Pagina ".$datosF->pagina." de ".$numerodepaginas." &nbsp; &nbsp; &nbsp; </p>";
            if($datosF->pagina != 1){
          ?>
              <a  onclick="MisIncidencias(<?php echo $paginas=$datosF->pagina-1;?>)" class="float" style="text-decoration:none" id="cursor"> <span class="glyphicon glyphicon-chevron-left">  </span> Atras   </a>
          <?php } ?>   
      </div>
    <br>
    <form class="formulario1" enctype="multipart/form-data" method="post">
       <br>
        <input type="hidden" name="cod_ser" value="<?php echo $datosF->cod_ser;?>">
        <input type="hidden" name="con" value="<?php echo $datosF->con;?>">
           
        <div class="col-xs-6"> 
             <div class=" col-xs-12"><br>
                    <label class="col-xs-4"> <span class="glyphicon glyphicon-user"></span>  Creador </label>
                <div class="col-xs-8">
                    <input type="text" readonly="readonly" class="form-control" name="creador_inc" id="creador_inc"  value="<?php echo $datosF->creador; ?>">
                </div>

            </div>
                  <div class="col-xs-12"> <br>
                    <label  class="col-xs-4"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                    <div class="col-xs-8">
                        <input type="date"  readonly="readonly" class="form-control" name="fechaInc" id="fechaInc" value="<?php echo $datosF->fechaInc; ?>">
                    </div>
                 </div>
                 <div class="col-xs-12"><br>
                       <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                        <div class="col-xs-8">
                                <input type="time" readonly="readonly"  class="form-control" name="horaInc" id="horaInc"  value="<?php echo $datosF->horaInc; ?>">
                        </div>
                </div>
               <div class="col-xs-12"><br>
                   <label  class="col-xs-4"><span class="glyphicon glyphicon-list"></span> Servicio   Afectado</label>
                    <div class="col-xs-8">
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
                    <label  class="col-xs-4">Responsable</label>
                    <div class="col-xs-8">
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
        <div class="col-xs-6" >
                    
                    <div class="col-xs-12 float"><br>
                             <label class="col-xs-offset-4 col-xs-3"><span class="glyphicon glyphicon-sta"></span>Numero:</label>
                        <div class="col-xs-4">
                             <input type="numero" readonly="readonly" class="form-control float" name="numeroInci" id="numeroInci"  value="<?php echo $datosF->cod_inc; ?>">
                        </div>
                    </div>
        </div>
        
        <div class="col-xs-12">
              <div id="resul" class="float">
              
           </div>
        </div>
          <div class="col-xs-12" >
           <div id='ns'>
               <a  onclick="NuevoSoporte(<?php echo $datosF->cod_inc;?>)" class="float" id="cursor">Nuevo Soporte <span class="glyphicon glyphicon-plus-sign"></span></a>
           </div>
        </div>
        <input type="hidden" name="nuevoS" id="nuevoS" value="false">
       
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
            
           
         ?>
        <div class="col-xs-12" >
             <hr class="hrcolor df">
             <h3>Soporte # <?php echo $datosF->num;?></h3>
        </div>
        <input type="hidden" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'codigosoporte';} else {echo 'codigosoporte1';}?>" value="<?php echo $datosF->cod_sop;?>">
        <div class="col-xs-6" >
            <div class="col-xs-12"> <br>
                    <label  class="col-xs-4"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                    <div class="col-xs-8">
                        <input type="date"  readonly="readonly" class="form-control" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'fechaCre';}else{echo 'fechaCre1';}?>" id="fechaCre<?php echo $datosF->num;?>" value="<?php echo $datosF->fechaCre; ?>">
                    </div>
                 </div>
                 <div class="col-xs-12"><br>
                       <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                        <div class="col-xs-8">
                                <input type="time" readonly="readonly"  class="form-control" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'horaCre';}else{echo 'horaCre1';}?>" id="horaCre<?php echo $datosF->num;?>"  value="<?php echo $datosF->horaCre; ?>">
                        </div>
                </div>
            <div class="col-xs-12"><br>
                <label class="col-xs-4"><span class="glyphicon glyphicon-wrench"></span> Tecnicos</label>
              <?php
                if($datosF->creador == $_SESSION['nombres']){
                echo '<div class="col-xs-8 checkbox">';
                }else{
                    if($_SESSION['rol'] == 1){
                        if($datosF->fechaCerrar_sop != "9999-12-31"){
                               echo '<div class="col-xs-8 checkbox disabled">';
                        }else{
                             echo '<div class="col-xs-8 checkbox">';
                        }
                       
                    }else{
                    if($datosF->fechaCerrar_sop != "9999-12-31"){
                               echo '<div class="col-xs-8 checkbox disabled">';
                        }else{
                             echo '<div class="col-xs-8 checkbox">';
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
                                                    <label><input type="checkbox" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'tecnicos';}else{echo 'tecnicos1[]';}?>"  <?php if($datosF->fechaCerrar_sop != "9999-12-31"){echo 'disabled';}else{if($datosF->creador != $_SESSION['nombres']){ if($_SESSION['rol'] == 1){}else{ echo 'disabled';}}}?> checked id="tecnicos" value="<?php echo $row['documento_usu']; ?>"><?php echo $row['nombre_usu'].' '.$row['apellido_usu']; ?></label><br>
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
                                    <label><input type="checkbox" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'tecnicos';}else{echo 'tecnicos1[]';} ?>" <?php if($datosF->fechaCerrar_sop != "9999-12-31"){echo 'disabled';}else{ if($datosF->creador != $_SESSION['nombres']){ if($_SESSION['rol'] == 1){}else{ echo 'disabled';}}}?> id="tecnicos" value="<?php echo $row['documento_usu']; ?>"><?php echo $row['nombre_usu'].' '.$row['apellido_usu']; ?></label><br>
                                                   
                                            <?php
                                         }
                                      }
                                      
                                      
                                  }else{
                                        $query=$datosF->SelectTecnicos();
                                        while($row=mysqli_fetch_array($query)){
                                            ?>
                                            <label><input type="checkbox" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'tecnicos';}else{echo 'tecnicos1[]';}?>" <?php if($datosF->fechaCerrar_sop != "9999-12-31"){echo 'disabled';}else{if($datosF->creador != $_SESSION['nombres']){ if($_SESSION['rol'] == 1){}else{ echo 'disabled';}}}?> id="tecnicos" value="<?php echo $row['documento_usu']; ?>"><?php echo $row['nombre_usu'].' '.$row['apellido_usu']; ?></label><br>
                                      <?php
                  }
                                  }
                               echo '</div>';
                            ?>
                
            </div>
                <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Descripcion del Problema</label>
                              <textarea <?php if($datosF->fechaCerrar_sop != "9999-12-31"){echo 'disabled';}else{if($datosF->creador != $_SESSION['nombres']){ if($_SESSION['rol'] == 1){}else{ echo 'disabled';}}}?> name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'descripcionServicio';}else{echo 'descripcionServicio1';}?>" id="descripcionServicio<?php echo $datosF->num;?>" class="form-control" rows="10" cols="40"><?php echo $datosF->descripcionProblem; ?></textarea>
                           <span id="descripcion<?php echo $datosF->num;?>"></span>
                        </div>
                    </div>
                 
        </div>
                <div class="col-xs-6" >
                   <div class="col-xs-12"><br>
                        <label  class="col-xs-4"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                       <div class="col-xs-8">
                            <input type="file" <?php if($datosF->fechaCerrar_sop != "9999-12-31"){echo 'disabled';}else{if($datosF->creador != $_SESSION['nombres']){if($_SESSION['rol'] == 1){}else{ echo 'disabled';}}}?> onchange="Archivo('verarchivo<?php echo $datosF->num;?>','controlador/Archivo.php',<?php echo $datosF->PoscImagen=$datosF->num;?>)" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'archivoIncidencia';}else{echo 'archivoIncidencia1';}?>" class="form-control" id="archivoIncidencia<?php echo $datosF->num;?>">
                        </div>
                 </div>
                  
                    <div id="verarchivo<?php echo $datosF->num;?>" class="col-xs-offset-3 col-xs-8"><br><br>
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
        <input type="hidden" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'valorImagen';}else{echo 'valorImagen1';}?>" id="valorImagen<?php echo $datosF->num;?>" value="<?php echo $ver; ?>">
        <div class="col-xs-12">
            <h3>Cerrar Soporte</h3>
            <div class="col-xs-6">
                     <div class="col-xs-12"> <br>
                        <label  class="col-xs-4"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                        <div class="col-xs-8">
                            <input type="date" <?php if($_SESSION['rol'] != 3 or $_SESSION['rol'] != 1){ echo 'readonly="readonly"';} ?>  class="form-control" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'fechaCerr';}else{echo 'fechaCerr1';}?>"id="fechaCerr<?php echo $datosF->num;?>" value="<?php echo $datosF->fechaCerrar_sop; ?>">
                        </div>
                     </div>
                     <div class="col-xs-12"><br>
                           <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                            <div class="col-xs-8">
                                    <input type="time" <?php if($_SESSION['rol'] != 3){ echo 'readonly="readonly"';} ?>  class="form-control" name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'horaCerr';}else{echo 'horaCerr1';}?>" id="horaCerr<?php echo $datosF->num;?>"  value="<?php echo $datosF->horaCerrar_sop; ?>">
                            </div>
                    </div>
                 <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Solucion</label>
                              <textarea <?php if($_SESSION['rol'] != 3){ echo 'readonly="readonly"';} ?>  name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'solucion';}else{echo 'solucion1';}?>" id="solucion<?php echo $datosF->num;?>" class="form-control" rows="10" cols="40"><?php echo $datosF->solucion_sop; ?></textarea>
                         </div>
                    </div>
                
            </div>
            <div class="col-xs-6" >
                   
                    <div class="col-xs-12"><br>
                            <label  class="col-xs-4"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                           <div class="col-xs-8">
                                <input type="file" <?php if($_SESSION['rol'] != 3){ echo 'readonly="readonly" ';} ?>  name="<?php if($datosF->fechaCerrar_sop != '9999-12-31'){ echo'cerrararchivoIncidencia';}else{echo 'cerrararchivoIncidencia1';}?>" class="form-control" id="cerrararchivoIncidencia<?php echo $datosF->num;?>">
                            </div>
                     </div>
                    <div id="verarchivoCerr<?php echo $datosF->num;?>" class="col-xs-offset-3 col-xs-8"><br><br>
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
                        $ver=$imagen;
                          echo "<br><br><img src='".$url."' style='width:70%;heigth:170px;' class='img-thumbnail'>";
                              echo '<br><center><a onclick="VerArchivo(\''.$ver.'\',\''.$compara.'\')" id="cursor">Ver <span class="glyphicon glyphicon-eye-open"></span></a></center>';

                        ?>
                        <input type="hidden" name="valorImagenCerrar<?php echo $datosF->num;?>" value="<?php echo $ver;?>" >
                    </div>
                </div>
        </div>
        
    <input id="numerosopor" name="numerosopor" type="hidden" value="<?php echo $datosF->num;?>">
       
        
  <div class="col-xs-12"><br>
            
        </div>
        <?php if($datosF->fechaCerrar_sop == '9999-12-31'){?>
              <div class="col-xs-12">
                <button type="button" <?php if($_SESSION['rol'] == 1){}else{if($datosF->creador != $_SESSION['nombres']){ echo 'disabled';}}?> onclick="CrearIncidencia('controlador/ActualizarIncidencia.php',<?php echo $datosF->num;?>)" class="btn btn-info float"><span class="glyphicon glyphicon-reload"></span>  Actualizar</button>

            </div>
            
<?php
                        }
    
             $datosF->num=$datosF->num-1;
         }
          ?>
<div id="nuevosoporte">
            
        </div>

    </form>
    </div>
      
 
<?php    }
     

     $datosF->pagina=$datosF->pagina;
 $revPag=$revPag+1;
 }
$_SESSION['datosF']=$datosF;
?>