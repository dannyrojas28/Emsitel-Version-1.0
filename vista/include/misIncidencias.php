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
$Incidencias=$datosF->VerIncidencias($datosF->cod_ser);
$numerodepaginas=mysqli_num_rows($Incidencias);
 while($row=mysqli_fetch_array($Incidencias)){
     
     if($revPag == $datosF->pagina){
         $datosF->creador= $row['creador_inc'];
         $datosF->cod_inc=$row['cod_inc'];
         $datosF->fechaCre=$row['fechaCre_inc']; 
         $datosF->horaCre=$row['horaCre_inc'];
         $datosF->descripcionProblem=$row['descripcion_inc'];
         $datosF->TecnicoResponsable=$row['responsable_inc'];
         $datosF->archivoCre=$row['archivoCre_inc'];
         $datosF->solucion_inc=$row['solucion_inc'];
         $datosF->archivoCer=$row['archivoCer_inc'];
         $datosF->fechaCerr=$row['fechaCer_inc'];
         $datosF->horaCerr=$row['horaCer_inc'];
     ?>
<div id="incidencias">
    <script type="text/javascript">
        document.getElementById('creador_inc').focus();
        var valorImagen=$('#valorImagen').val();
        document.getElementById('archivoIncidencia').value=valorImagen;
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
                        <input type="date"  readonly="readonly" class="form-control" name="fechaCre" id="fechaCre" value="<?php echo $datosF->fechaCre; ?>">
                    </div>
                 </div>
                 <div class="col-xs-12"><br>
                       <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                        <div class="col-xs-8">
                                <input type="time" readonly="readonly"  class="form-control" name="horaCre" id="horaCre"  value="<?php echo $datosF->horaCre; ?>">
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
                <label class="col-xs-4"><span class="glyphicon glyphicon-wrench"></span> Tecnicos</label>
              <?php
                if($datosF->creador == $_SESSION['nombres']){
                echo '<div class="col-xs-8 checkbox">';
                }else{
                    echo '<div class="col-xs-8 checkbox disabled">';
                }
         
               
                                $MisTecnicos=$datosF->SelectTecnicosInciPersonales($datosF->cod_inc);
                                  if(mysqli_num_rows($MisTecnicos) > 0){
                                      $inicie=0;
                                      while($tecnico=mysqli_fetch_array($MisTecnicos)){
                                           $query=$datosF->SelectTecnicos();
                                        while($row=mysqli_fetch_array($query)){
                                                
                                                if($tecnico['cod_usuario'] == $row['documento_usu']){
                                                    echo '<label><input checked type="checkbox" name="tecnicos[]" id="tecnicos" value="'.$row['documento_usu'].'">'.$row['nombre_usu'].' '.$row['apellido_usu'].'</label>';
                                                }else{
                                                            echo '<label><input type="checkbox" name="tecnicos[]" id="tecnicos" value="'.$row['documento_usu'].'">'.$row['nombre_usu'].' '.$row['apellido_usu'].'</label>';
                                                         

                                                }
                                            $inicie=$inicie+2;
                                        }
                                          
                                      }
                                  }else{
                                        $query=$datosF->SelectTecnicos();
                                        while($row=mysqli_fetch_array($query)){
                                            echo '<label><input type="checkbox" name="tecnicos[]" id="tecnicos" value="'.$row['documento_usu'].'">'.$row['nombre_usu'].' '.$row['apellido_usu'].'</label>';
                                        }
                                  }
                               echo '</div>';
                            ?>
                
            </div>
                <div class="col-xs-12"><br>
                    <label  class="col-xs-4">Responsable</label>
                    <div class="col-xs-8">
                        <select name="TecnicoResponsable" <?php if($datosF->creador != $_SESSION['nombres']){ echo 'disabled';}?> class="form-control" id="TecnicoResponsable">
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
                    </div>
                </div>

                 <div class="col-xs-12"><br>
                        <label  class="col-xs-4"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                       <div class="col-xs-8">
                            <input type="file" <?php if($datosF->creador != $_SESSION['nombres']){ echo 'disabled';}?> onchange="Archivo('verarchivo')" name="archivoIncidencia" class="form-control" id="archivoIncidencia">
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
                    <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Descripcion del Problema</label>
                              <textarea <?php if($datosF->creador != $_SESSION['nombres']){ echo 'disabled';}?> name="descripcionServicio" id="descripcionServicio" class="form-control" rows="10" cols="40"><?php echo $datosF->descripcionProblem; ?></textarea>
                         </div>
                    </div>
                    <div id="verarchivo" class="col-xs-offset-3 col-xs-8"><br><br>
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
        <input type="hidden" id="valorImagen" value="<?php echo $ver; ?>">
        <div class="col-xs-12">
            <hr class="hrcolor">
            <h3>Cerrar Incidencia</h3>
            <div class="col-xs-6">
                     <div class="col-xs-12"> <br>
                        <label  class="col-xs-4"><span class="glyphicon glyphicon-calendar"></span>  Fecha</label>
                        <div class="col-xs-8">
                            <input type="date" <?php if($_SESSION['rol'] != 3){ echo 'readonly="readonly"';} ?>  class="form-control" name="fechaCerr" id="fechaCerr" value="<?php echo $datosF->fechaCerr; ?>">
                        </div>
                     </div>
                     <div class="col-xs-12"><br>
                           <label  class="col-xs-4"> <span class="glyphicon glyphicon-time"></span> Hora</label>
                            <div class="col-xs-8">
                                    <input type="time" <?php if($_SESSION['rol'] != 3){ echo 'readonly="readonly"';} ?>  class="form-control" name="horaCerr" id="horaCerr"  value="<?php echo $datosF->horaCerr; ?>">
                            </div>
                    </div>
                    <div class="col-xs-12"><br>
                            <label  class="col-xs-4"> <span class="glyphicon glyphicon-folder-open"></span>  Archivos </label>
                           <div class="col-xs-8">
                                <input type="file" <?php if($_SESSION['rol'] != 3){ echo 'readonly="readonly" ';}else{ echo 'onchange="Archivo(\'verarchivo2\')"';} ?>  name="cerrararchivoIncidencia" class="form-control" id="cerrararchivoIncidencia">
                            </div>
                     </div>
                 <div class="col-xs-12"><br>
                             
                        <div class="col-xs-12">
                            <label ><span class="glyphicon glyphicon-sta"></span>Solucion</label>
                              <textarea <?php if($_SESSION['rol'] != 3){ echo 'readonly="readonly"';} ?>  name="solucion" id="solucion" class="form-control" rows="10" cols="40"><?php echo $datosF->solucion_inc; ?></textarea>
                         </div>
                    </div>
                
            </div>
            <div class="col-xs-6" >
                   
                    <div id="verarchivo2" class="col-xs-offset-3 col-xs-8"><br><br>
                        <img src="<?php echo $datosF->archivoCer;?>" style='width:70%;heigth:170px;' class="img-thumbnail">
                    </div>
                </div>
        </div>
        <div class="col-xs-12">
            <button type="button" <?php if($datosF->creador != $_SESSION['nombres']){ echo 'disabled';}?> onclick="CrearIncidencia()" class="btn btn-info float"><span class="glyphicon glyphicon-reload"></span>  Actualizar</button>
            
        </div>
    </form>
    
        <div class="col-xs-12"><br>
            
        </div>
</div>
 
<?php
     }
 $revPag=$revPag+1;
 }
$_SESSION['datosF']=$datosF;
?>