<?php
include "../modelo/Datos.php";
$datosF=new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF=$_SESSION['datosF'];
}
if(!empty($_POST['fechainicio'])){
    $datosF->fechaInicio=$_POST['fechainicio'];
    $datosF->fechaFin=$_POST['fechafin'];
    $datosF->generarPor=$_POST['generarpor'];
    $datosF->busqueda=$_POST['busqueda'];
   $datosF->igualar="";
}

 $datosF->sumAbiertas=0;
    $datosF->sumCerradas=0;
$num=$_POST['numRegistros'];
if($num == 0){
     $datosF->igualar="";
    $datosF->contar=0;

}else{
    $numPer=$_POST['numPer'];
    if($_POST['gt'] == 1){
        $datosF->contar=$num - $_POST['gt'];
    }
}
$numeroReg=$num;
switch ($datosF->generarPor){
     case 1:
        $tetxo=null;
        $tetxoP=null;
        $tetxoE=null;
            $titulo="Total De Incidencias del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
            $tablasoporte="SoportesIncidenciasPersonales";
            $tablaIni="Incidencias_Personales";
            $tabla="";
            $tetxoC="group by SoportesIncidenciasPersonales.cod_inc";
            for($i=1;$i <= 2;$i++){
               $queryA[$i]=$datosF->NumeroIncidenciasAbiertas($tablaIni,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxo);
               $queryC[$i]=$datosF->NumeroIncidenciasCerradas($tablaIni,$tablasoporte,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxoC);
               $tablasoporte="SoportesIncidenciasEmpresas";
              $tablaIni="Incidencias_Empresariales";
            $tetxoC="group by SoportesIncidenciasEmpresas.cod_inc";
            }
 $datosF->fechaFinD=$datosF->fechaFin;
        break;
    
    case 2:
        $query=$datosF->BD_TiposServicio();
                while($row=mysqli_fetch_array($query)){
                     if($datosF->busqueda == $row['cod_tp']){
                            $servicio=$row['nombre_tp'];
                        }
                }
       
        $titulo="Total De Incidencias Por Servicio de ".$servicio." Del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
        $tablasoporte="SoportesIncidenciasPersonales";
        $tablaIni="Incidencias_Personales";
        $tabla=",tiposervicio_personal";
        $tetxo=" and Incidencias_Personales.cod_servicio=tiposervicio_personal.cod_ser and tiposervicio_personal.tiposervicio=".$datosF->busqueda;
        $tetxo2="and Incidencias_Personales.cod_servicio=tiposervicio_personal.cod_ser and tiposervicio_personal.tiposervicio=".$datosF->busqueda.' group by SoportesIncidenciasPersonales.cod_inc';
        for($i=1;$i <= 2;$i++){
           $queryA[$i]=$datosF->NumeroIncidenciasAbiertas($tablaIni,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxo);
           $queryC[$i]=$datosF->NumeroIncidenciasCerradas($tablaIni,$tablasoporte,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxo2);
           $tablasoporte="SoportesIncidenciasEmpresas";
           $tablaIni="Incidencias_Empresariales";
           $tabla=",tiposervicio_empresarial";
           $tetxo="and Incidencias_Empresariales.cod_servicio=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.tipo_servicio_emp=".$datosF->busqueda;
           $tetxo2="and Incidencias_Empresariales.cod_servicio=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.tipo_servicio_emp=".$datosF->busqueda.' group by SoportesIncidenciasEmpresas.cod_inc';
       
        }
    $tetxoE="and tiposervicio_empresarial.tipo_servicio_emp=".$datosF->busqueda;
    $tetxoP="and tiposervicio_personal.tiposervicio=".$datosF->busqueda;
     $datosF->fechaFinD=$datosF->fechaFin;
    break;
    
    case 3: 
        $titulo="Total De Incidencias Por Creador ".$datosF->busqueda." Del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
        $tablasoporte="SoportesIncidenciasPersonales";
        $tablaIni="Incidencias_Personales";
        $tabla="";
        $tetxo=" and Incidencias_Personales.creador_inc='".$datosF->busqueda."'";
        for($i=1;$i <= 2;$i++){
           $queryA[$i]=$datosF->NumeroIncidenciasAbiertas($tablaIni,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxo);
           $queryC[$i]=$datosF->NumeroIncidenciasCerradas($tablaIni,$tablasoporte,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxo);
           $tablasoporte="SoportesIncidenciasEmpresas";
           $tablaIni="Incidencias_Empresariales";   
           $tetxo="and Incidencias_Empresariales.creador_inc='".$datosF->busqueda."'";
        }
     $datosF->fechaFinD=$datosF->fechaFin;
    $tetxoE="and Incidencias_Empresariales.creador_inc='".$datosF->busqueda."'";
    $tetxoP="and Incidencias_Personales.creador_inc='".$datosF->busqueda."'";
    break;
    
    case 4:
     $query=$datosF->SelectTecnicos();
             while($row=mysqli_fetch_array($query)){
                     if($datosF->busqueda == $row['documento_usu']){
                        $name=$row['nombre_usu'].' '.$row['apellido_usu'];   
                     }
             }
        $titulo="Incidencias Cerradas por ".$name." Del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
        $tablasoporte="SoportesIncidenciasPersonales";
        $tablaIni="Incidencias_Personales";
        $tabla="";
    $tetxo="";
        $tetxoC=" and Incidencias_Personales.responsable_inc='".$datosF->busqueda."' group by SoportesIncidenciasPersonales.cod_inc";
        for($i=1;$i <= 2;$i++){
           $queryA[$i]=$datosF->NumeroIncidenciasAbiertas($tablaIni,$tabla,'10','10',"");
           $queryC[$i]=$datosF->NumeroIncidenciasCerradas($tablaIni,$tablasoporte,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxoC);
           $tablasoporte="SoportesIncidenciasEmpresas";
           $tablaIni="Incidencias_Empresariales";   
           $tetxoC="and Incidencias_Empresariales.responsable_inc='".$datosF->busqueda."' group by SoportesIncidenciasEmpresas.cod_inc";
        }
    
    $datosF->fechaFinD="11";
    $tetxoE="and Incidencias_Empresariales.responsable_inc='".$datosF->busqueda."'";
    $tetxoP="and Incidencias_Personales.responsable_inc='".$datosF->busqueda."'";
    break;
       
} 
 $sum=1;    
    while($row=mysqli_fetch_array($queryA[2])){
       $InformesEmpresas=$row['numero'];
    }
       $comparar=$num+25;
  if($num == 25){
        $datosF->numeroEmpresas=$datosF->emo;
  }
       if($InformesEmpresas >= $comparar){
           $datosF->numeroEmpresas=$InformesEmpresas - $comparar;
           $datosF->emo=$datosF->numeroEmpresas;
           $datosF->fechaInicioE=$datosF->fechaInicio;
           $numPaginaPers='';
           $datosF->fechaInicioP="9999-00-00";
           $numPaginaEmpr='limit '.$num.',25';
           $numPeraz=0;
       }else{
           if($InformesEmpresas < 25){
               if(empty($datosF->igualar)){
                   
                   $numEmpr=$InformesEmpresas;
                   $numPaginaEmpr='limit '.$numEmpr.'25';
                   $datosF->igualar="sdsdsd";
                   $numPer=25 - $numEmpr;
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $datosF->fechaInicioE=$datosF->fechaInicio;
                   $numPaginaPers='limit 0,'.$numPer;
                    $numPeraz=$numPer+1;
                   $datosF->emo=0;
               }else{
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $datosF->emo=0;
                   $numPaginaPers='limit '. $numPer.',25';
                   $numPaginaEmpr="";
                   $datosF->fechaInicioE="9999-12-31";
                   $numPeraz=$numPer+25;
               }
           }else{
               if($datosF->numeroEmpresas != 0){
                   $numPaginaEmpr='limit '.$num.',25';
                   $datosF->fechaInicioE=$datosF->fechaInicio;
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $numPer=25 - $datosF->numeroEmpresas;
                   $numPaginaPers='limit 0,'.$numPer;
                   $numPeraz=$numPer+1;
                   $datosF->emo=$datosF->numeroEmpresas;
                   $datosF->numeroEmpresas=0;
               }else{
                   $numPaginaEmpr="";
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $numPaginaPers='limit '. $numPer.',25';
                   $datosF->fechaInicioE="9999-00-00";
                  $numPeraz=$numPer+25;
                   
                   
               }
           }
       }
        $queryPersonal[1]=$datosF->InformeTotalInciPerso($numPaginaPers,$datosF->fechaInicioP,$datosF->fechaFinD,$tetxoP);
        $queryEmpresarial[1]=$datosF->InformeTotalInciEmpre($numPaginaEmpr,$datosF->fechaInicioE,$datosF->fechaFinD,$tetxoE);
         $queryPersonal[2]=$datosF->InformeTotalInciCerraPerso($numPaginaPers,$datosF->fechaInicioP,$datosF->fechaFin,$tetxoP);
        $queryEmpresarial[2]=$datosF->InformeTotalInciCerraEmpre($numPaginaEmpr,$datosF->fechaInicioE,$datosF->fechaFin,$tetxoE);
$var=false;
if($datosF->generarPor != 3  ){
      for($i=1;$i <= 2;$i++){
         while($row=mysqli_fetch_array($queryA[1])){
            if($row['numero'] != 0){ 
                $datosF->sumAbiertas=$row['numero']+$InformesEmpresas;
                 $var=true;
            }else{
                if($InformesEmpresas != 0){
                    $datosF->sumAbiertas=$InformesEmpresas;
                    $var=true;
                }
            }
         }
   }
     for($i=1;$i <= 2;$i++){
         $sumaCerradas=mysqli_num_rows($queryC[$i]);
         $datosF->sumCerradas=$datosF->sumCerradas + $sumaCerradas;
         if($datosF->sumCerradas != 0){
             $var=true;
         }
     }
    
  
}else{
   for($i=1;$i <= 2;$i++){
         while($row=mysqli_fetch_array($queryA[1])){
            if($row['numero'] != 0){ 
                $datosF->sumAbiertas=$row['numero']+$InformesEmpresas;
                 $var=true;
            }else{
                if($InformesEmpresas != 0){
                    $datosF->sumAbiertas=$InformesEmpresas;
                    $var=true;
                }
            }
         }

        while($row=mysqli_fetch_array($queryC[$i])){
             if($row['numero'] != 0){
                $datosF->sumCerradas=$row['numero']+$datosF->sumCerradas;
               $var=true;
             }
        }

    }
}
?>

<?php 

if($var == true){
  ?>  <div class="col-xs-12">
        <a   onclick="DowloandInforme()" class="float" id="cursor"> <span class="glyphicon glyphicon-save"> Descargar (.pdf)</span></a>
<br>
            <h3 style="color:green;"><?php echo $titulo; ?></h3><br>
                   <div class="col-xs-3"> 
                    <table class="table table-bordered">
            <?php if($datosF->generarPor != 4){ ?>
                
                    <tr>
                      <td class="info">Incidencias Creadas </td>
                      <td class="warning"><?php echo $datosF->sumAbiertas; ?></td>
                    </tr>
             <?php } 
                        if($datosF->generarPor != 3){
                ?>
                    <tr>
                      <td class="info">Incidencias Cerradas </td>
                      <td class="warning"><?php echo $datosF->sumCerradas; ?></td>
                    </tr>
                <?php } ?>
                </table>
            </div>
        </div>
<div class="col-xs-12">
    <?php
    if($datosF->sumAbiertas > 25){
       $numeroPaginas=1;
        $sum=0;
        for($i=0;$i < $datosF->sumAbiertas;$i++){
            $sum=$sum+1;
            if($sum == 25){
                $numeroPaginas=$numeroPaginas+1;
                $sum=0;
            }
            
        }
    }else{
        
        $numeroPaginas=1;
    }
        if($num == 0){
            $pagina=1;
        }else{
            $pagina=$_POST['numPagina'];
        }
        if($pagina != $numeroPaginas){
            $numPersona=0;
     ?>
                    <a  onclick="PrevInforme('controlador/GenerarInforme.php',<?php echo $numPersona=$numPeraz; ?>,<?php echo $numeroReg=$num+25;?>,<?php echo $paginas=$pagina+1;?>,<?php echo $gt=2?> )" class="float" style="text-decoration:none" id="cursor">  Siguiente<span class="glyphicon glyphicon-chevron-right"> </span> </a> 
    <?php  }
         echo " <p class='float'>&nbsp; &nbsp; &nbsp; Pagina ".$pagina." de ".$numeroPaginas." &nbsp; &nbsp; &nbsp; </p>";
        if($pagina != 1){
                
            
      ?>
        
           <a  onclick="PrevInforme('controlador/GenerarInforme.php',<?php echo $numPersona=$numPeraz - 50; ?>,<?php  echo $numeroReg=$num-25;?>,<?php echo $paginas=$pagina-1;?>,<?php echo $gt=1;?>)" class="float" style="text-decoration:none" id="cursor"> <span class="glyphicon glyphicon-chevron-left">  </span> Atras   </a>
           
    <?php  }
    ?>
      
</div>
<?php
echo '<table class="table table-bordered">
                    <tr>
                      <td class="info">Nit/Cedula</td>
                      <td class="info">Nombre</td>
                      <td class="info">Ubicacion</td>
                      <td class="info">Contrato</td>
                      <td class="info">Descripcion del Problema</td>
                      <td class="info">Solucion</td>';
                       if($datosF->generarPor != 4){
                          echo '<td class="info">Tecnico</td>';
                       }else{
                           echo '<td class="info">Fecha Inicio</td>
                                 <td class="info">Fecha Cerrar</td>';
                       }
                     
                    echo '
                    </tr>';
    
    for($i=1;$i <= 2;$i++){
        while($row=mysqli_fetch_array($queryEmpresarial[$i])){
            $datosF->contar=$datosF->contar+1;
            $query=$datosF->SelectTecnicos();
                         while($rows=mysqli_fetch_array($query)){
                            if($row['responsable_inc'] == $rows['documento_usu']){

                               $Tecnico=$rows['nombre_usu'].' '.$rows['apellido_usu'];
                            }
                         }
                echo '<tr> 
                          <td class="success">'.$row['nitcedula_emp'].'</td>
                          <td class="success">'.$row['nombre_emp'].'</td>
                          <td class="success">'.$row['nombreubi_emp'].' - '.$row['direccionubi_emp'].' - '.$row['nombre_mun'].'</td>
                          <td class="success">'.$row['nombre_forE'].$row['numcontrato_emp'].'</td>
                          <td class="success">'.$row['descripcion_sop'].'</td>
                          <td class="success">'.$row['solucion_sop'].'</td>';
                    
                          if($datosF->generarPor != 4){
                          echo '<td class="success">'.$Tecnico.'</td>';
                          }else{
                           echo   '<td class="success">'.$row['fechaCrear_sop'].' '.$row['horaCrear_sop'].'</td>
                                  <td class="success">'.$row['fechaCerrar_sop'].' '.$row['horaCerrar_sop'].'</td>';
                          }
                   echo    ' <td class="warning">'.$row['cod_inc'].'.E</td>
                            </tr>';

        }
    }
    for($i=2;$i >= 1;$i--){
        while($row=mysqli_fetch_array($queryPersonal[$i])){
            $datosF->contar=$datosF->contar+1;
            $query=$datosF->SelectTecnicos();
                         while($rows=mysqli_fetch_array($query)){
                            if($row['responsable_inc'] == $rows['documento_usu']){

                               $Tecnico=$rows['nombre_usu'].' '.$rows['apellido_usu'];
                            }
                         }
                echo '<tr> 
                          <td class="success">'.$row['cedula_cli'].'</td>
                          <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                          <td class="success">'.$row['nombre_ubi'].' - '.$row['direccion_ubi'].' - '.$row['nombre_mun'].'</td>
                          <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
                          <td class="success">'.$row['descripcion_sop'].'</td>
                          <td class="success">'.$row['solucion_sop'].'</td>';
                    
                          if($datosF->generarPor != 4){
                          echo '<td class="success">'.$Tecnico.'</td>';
                          }else{
                           echo   '<td class="success">'.$row['fechaCrear_sop'].' '.$row['horaCrear_sop'].'</td>
                                  <td class="success">'.$row['fechaCerrar_sop'].' '.$row['horaCerrar_sop'].'</td>';
                          }
                   echo    '<td class="warning">'.$row['cod_inc'].'.P</td>
                            </tr>';

        }
    }
    echo 
        '</table>';
   
 }else{
   echo ' <h2 style="color:green;"><?php echo $titulo; ?></h2><br><center><h3 color="red">No Se han encontrado resultados</h3>';
}

$_SESSION['datosF']=$datosF;
?>