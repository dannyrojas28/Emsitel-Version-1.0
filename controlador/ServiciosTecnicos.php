<?php
include "../modelo/Datos.php";
session_start();
$datosF = new Datos();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
echo "<div class='col-xs-12'><br></div>";
$SelecResponsable=$datosF->SelecResponsable($_SESSION['documento']);
 $var=0;
if(mysqli_num_rows($SelecResponsable) > 0){
   
    while($rows=mysqli_fetch_array($SelecResponsable)){
        $query=$datosF->SelectServiciosTecnico($rows['cod_inc']);
            if(mysqli_num_rows($query) > 0){
                while($row=mysqli_fetch_array($query)){
                    if($row['fechaCerrar_sop'] == '0000-00-00' ){
                        $var=1;
                           ?><br>
                                <div class="col-xs-12 col-sm-6">
                                        <a class="list-group-item list-group-item-success" onclick="MostrarDetallesTecnicos( <?php echo $row['cod_inc'].','.$row['cod_servicio'].','.$col=1; ?>)" id="cursor"><?php echo $row['nombre_tp'].' - '.$row['nombre_for'].$row['numcontrato_ser'].' - '.$row['nombre_usu'].' '.$row['apellido_usu'].' - '.$row['fechaCrear_sop']; ?> <span class="float glyphicon glyphicon-chevron-right"></span></a>
                                         <br>
                                </div>
                        <?php
                            }
                }
           }
    }    
    $SelecOtrosTecnicos=$datosF->SelecOtrosTecnicos($_SESSION['documento']);
        if(mysqli_num_rows($SelecOtrosTecnicos) > 0){
            while($rows=mysqli_fetch_array($SelecOtrosTecnicos)){
                $codsoporte=$rows['cod_soporte'];
                $query=$datosF->SelectServiciosTecnico($rows['cod_inc']);
                    if(mysqli_num_rows($query) > 0){
                        while($row=mysqli_fetch_array($query)){
                            
                            if($row['fechaCerrar_sop'] == '0000-00-00' and $codsoporte == $row['cod_sop']){
                                $var=1;
                               ?> <br>
                                        <div class="col-xs-12 col-sm-6">
                                               <a class="list-group-item list-group-item-success" onclick="MostrarDetallesTecnicos(<?php echo $row['cod_inc'].','.$row['cod_servicio'].','.$col=1; ?>)" id="cursor"><?php echo $row['nombre_tp'].' - '.$row['nombre_for'].$row['numcontrato_ser'].' - '.$row['nombre_usu'].' '.$row['apellido_usu'].' - '.$row['fechaCrear_sop']; ?><span class="float glyphicon glyphicon-chevron-right"></span></a>
                                               <br>
                                      </div>
                                <?php
                             
                            }
                        }
                  }
            }
        }
}else{
    
        $SelecOtrosTecnicos=$datosF->SelecOtrosTecnicos($_SESSION['documento']);
        
        if(mysqli_num_rows($SelecOtrosTecnicos) > 0){
            while($rows=mysqli_fetch_array($SelecOtrosTecnicos)){
                $codsoporte=$rows['cod_soporte'];
                $query=$datosF->SelectServiciosTecnico($rows['cod_inc']);
                    if(mysqli_num_rows($query) > 0){
                        while($row=mysqli_fetch_array($query)){
                            if($row['fechaCerrar_sop'] == '0000-00-00' and $codsoporte == $row['cod_sop']){
                                $var=1;
                                ?> <br>
                                        <div class="col-xs-12 col-sm-6">
                                               <a class="list-group-item list-group-item-success" onclick="MostrarDetallesTecnicos(<?php echo $row['cod_inc'].','.$row['cod_servicio'].','.$col=1; ?>)" id="cursor"><?php echo $row['nombre_tp'].' - '.$row['nombre_for'].$row['numcontrato_ser'].' - '.$row['nombre_usu'].' '.$row['apellido_usu'].' - '.$row['fechaCrear_sop']; ?><span class="float glyphicon glyphicon-chevron-right"></span></a>
                                               <br>
                                      </div>
                                <?php
                             
                            }
                        }
                  }
            }
        }
    
}

$SelecResponsableEMP=$datosF->SelecEmpresaResponsable($_SESSION['documento']);
if(mysqli_num_rows($SelecResponsableEMP) > 0){
   
    while($rows=mysqli_fetch_array($SelecResponsableEMP)){
        $query=$datosF->SelectServiciosTecnicoEmpresa($rows['cod_inc']);
            if(mysqli_num_rows($query) > 0){
                while($row=mysqli_fetch_array($query)){
                    if($row['fechaCerrar_sop'] == '0000-00-00' ){
                       $var=1;
                           ?><br>
                                <div class="col-xs-12 col-sm-6">
                                
                                        <a class="list-group-item list-group-item-warning" onclick="MostrarDetallesTecnicos(<?php echo $row['cod_inc'].','.$row['cod_servicio'].','.$con=2;?>)" id="cursor"><?php echo $row['nombre_tp'].' - '.$row['nombre_forE'].$row['numcontrato_emp'].' - '.$row['nombre_usu'].' '.$row['apellido_usu'].' - '.$row['fechaCrear_sop']; ?><span class="float glyphicon glyphicon-chevron-right"></span></a>
                                         <br>
                                </div>
                        <?php
                            }
                }
           }
    }    
    $SelecOtrosTecnicosEmp=$datosF->SelecOtrosTecnicosEmpresa($_SESSION['documento']);
        if(mysqli_num_rows($SelecOtrosTecnicosEmp) > 0){
            while($rows=mysqli_fetch_array($SelecOtrosTecnicosEmp)){
                $codsoporte=$rows['cod_soporte'];
                $query=$datosF->SelectServiciosTecnicoEmpresa($rows['cod_inc']);
                    if(mysqli_num_rows($query) > 0){
                        while($row=mysqli_fetch_array($query)){
                            if($row['fechaCerrar_sop'] == '0000-00-00' and $codsoporte == $row['cod_sop']){
                                $var=1;
                              ?><br>
                                        <div class="col-xs-12 col-sm-6">
                                               <a class="list-group-item list-group-item-warning" onclick="MostrarDetallesTecnicos(<?php echo $row['cod_inc'].','.$row['cod_servicio'].','.$con=2;?>)" id="cursor"><?php echo $row['nombre_tp'].' - '.$row['nombre_forE'].$row['numcontrato_emp'].' - '.$row['nombre_usu'].' '.$row['apellido_usu'].' - '.$row['fechaCrear_sop']; ?> <span class="float glyphicon glyphicon-chevron-right"></span></a>
                                               <br>
                                      </div>
                <?php
                             
                            }
                        }
                  }
            }
        }
}else{
    
        $SelecOtrosTecnicosEmp=$datosF->SelecOtrosTecnicosEmpresa($_SESSION['documento']);
        
        if(mysqli_num_rows($SelecOtrosTecnicos) > 0){
            while($rows=mysqli_fetch_array($SelecOtrosTecnicos)){
                $codsoporte=$rows['cod_soporte'];
                $query=$datosF->SelectServiciosTecnico($rows['cod_inc']);
                    if(mysqli_num_rows($query) > 0){
                        while($row=mysqli_fetch_array($query)){
                            if($row['fechaCerrar_sop'] == '0000-00-00' and $codsoporte == $row['cod_sop']){
                              
                                $var=1; ?>
                                     <br>
                                        <div class="col-xs-12 col-sm-6">
                                               <a class="list-group-item list-group-item-warning" onclick="MostrarDetallesTecnicos(<?php echo $row['cod_inc'].','.$row['cod_servicio'].','.$con=2;?>)" id="cursor"><?php echo $row['nombre_tp'].' - '.$row['nombre_forE'].$row['numcontrato_emp'].' - '.$row['nombre_usu'].' '.$row['apellido_usu'].' - '.$row['fechaCrear_sop']; ?><span class="float glyphicon glyphicon-chevron-right"></span></a>
                                               <br>
                                      </div><?php
                             
                            }
                        }
                  }
            }
        }
    
}
    

 if($var == 0){
         echo '<br><div class="col-xs-12 col-sm-6"><span class="list-group-item list-group-item-danger">No tienes ningun servicio</span></div>';
         
    }
$_SESSION['datosF']=$datosF;
?>