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

}

switch ($datosF->generarPor){
     case 1:
        $titulo="Total De Incidencias del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
        $tablasoporte="SoportesIncidenciasPersonales";
        for($i=1;$i <= 2;$i++){
           $queryA[$i]=$datosF->NumeroIncidenciasAbiertas($tablasoporte,$datosF->fechaInicio,$datosF->fechaFin);
           $queryC[$i]=$datosF->NumeroIncidenciasCerradas($tablasoporte,$datosF->fechaInicio,$datosF->fechaFin);
           $tablasoporte="SoportesIncidenciasEmpresas";
        }
        
        
    $sum=1;    
    while($row=mysqli_fetch_array($queryA[2])){
        $InformesEmpresas=$row['COUNT(cod_sop)'];
    }
    echo $InformesEmpresas;
     $InformesEmpresas;
       $comparar=$num+25;
  if($num == 25){
        $datosF->numeroEmpresas=$datosF->emo;
  }
       if($InformesEmpresas >= $comparar){
           $datosF->numPer=0;
           $datosF->numeroEmpresas=$InformesEmpresas - $comparar;
           $datosF->emo=$datosF->numeroEmpresas;
           $datosF->fechaInicioE=$datosF->fechaInicio;
           $numPaginaPers='';
           $datosF->fechaInicioP="9999-00-00";
           $numPaginaEmpr='limit '.$num.',25';
       }else{
           if($InformesEmpresas < 25){
               if(empty($datosF->igualar)){
                   $numEmpr=$InformesEmpresas;
                   $numPaginaEmpr='limit '.$num.',25';
                   $datosF->igualar="sdsdsd";
                   $datosF->numPer=25 - $numEmpr;
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $datosF->fechaInicioE=$datosF->fechaInicio;
                   $numPaginaPers='limit '.$num.','.$datosF->numPer;
               }else{
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $numPaginaPers='limit '. $datosF->numPer.',25';
                   $numPaginaEmpr="";
                   $datosF->fechaInicioE="9999-12-31";
               }
           }else{
               if($datosF->numeroEmpresas != 0){
                   $numPaginaEmpr='limit '.$num.',25';
                   $datosF->fechaInicioE=$datosF->fechaInicio;
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $datosF->numPer=25 - $datosF->numeroEmpresas;
                   $numPaginaPers='limit 0,'.$datosF->numPer;
                   $datosF->emo=$datosF->numeroEmpresas;
                   $datosF->numeroEmpresas=0;
               }else{
                   $numPaginaEmpr="";
                   $datosF->fechaInicioP=$datosF->fechaInicio;
                   $numPaginaPers='limit '. $datosF->numPer.',25';
                   $datosF->fechaInicioE="9999-00-00";
                   
                   
               }
           }
       }
    
        $queryPersonal=$datosF->InformeTotalInciPerso($numPaginaPers,$datosF->fechaInicioP,$datosF->fechaFin);
        $queryEmpresarial=$datosF->InformeTotalInciEmpre($numPaginaEmpr,$datosF->fechaInicioE,$datosF->fechaFin);
    break;
    case 2:
        echo "polla";
    break;
    case 3:
        echo "polla21";
    break;
    case 4:
        echo "pola4";
    break;
       
} 
$var=false;
for($i=1;$i <= 2;$i++){
     while($row=mysqli_fetch_array($queryA[1])){
        if($row['COUNT(cod_sop)'] != 0){ 
            $datosF->sumAbiertas=$row['COUNT(cod_sop)']+$InformesEmpresas;
             $var=true;
        }else{
             $datosF->sumAbiertas=$InformesEmpresas;
        }
     }
    
    while($row=mysqli_fetch_array($queryC[$i])){
         if($row['COUNT(cod_sop)'] != 0){
            $datosF->sumCerradas=$datosF->sumCerradas+$row['COUNT(cod_sop)'];
           $var=true;
         }
    }
     
}
?>

<?php 

if($var == true){
  ?>  <div class="col-xs-12">
        <a   onclick="DowloandInforme()" class="float" id="cursor"> <span class="glyphicon glyphicon-save"> Descargar (.pdf)</span></a>

            <h2 style="color:green;"><?php echo $titulo; ?></h2><br>
            <p>Inicidencias Creadas  : <?php echo $datosF->sumAbiertas; ?></p>
            <p>Inicidencias Cerradas : <?php echo $datosF->sumCerradas; ?></p><br>

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
     ?>
                    <a  onclick="PrevInforme('controlador/GenerarInforme.php',<?php if($datosF->numPer != 0){ $datosF->numPer=$datosF->numPer+25;} echo $numeroReg=$num+25;?>,<?php echo $paginas=$pagina+1?>)" class="float" style="text-decoration:none" id="cursor">  Siguiente<span class="glyphicon glyphicon-chevron-right"> </span> </a> 
    <?php  }
         echo " <p class='float'>&nbsp; &nbsp; &nbsp; Pagina ".$pagina." de ".$numeroPaginas." &nbsp; &nbsp; &nbsp; </p>";
        if($pagina != 1){
      ?>
           <a  onclick="PrevInforme('controlador/GenerarInforme.php',<?php $datosF->numPer=25-$datosF->numPer; echo $numeroReg=$num-25;?>,<?php echo $paginas=$pagina-1;?>)" class="float" style="text-decoration:none" id="cursor"> <span class="glyphicon glyphicon-chevron-left">  </span> Atras   </a>
           
    <?php  } ?>
      
</div>
<?php
echo '<table class="table table-bordered">
                    <tr>
                      <td></td>
                      <td class="info">Nit/Cedula</td>
                      <td class="info">Nombre</td>
                      <td class="info">Ubicacion</td>
                      <td class="info">Contrato</td>
                      <td class="info">Descripcion del Problema</td>
                      <td class="info">Solucion</td>
                     
                    </tr>';
    while($row=mysqli_fetch_array($queryEmpresarial)){
            echo '<tr> '
                     .'<td>E</td>
                      <td class="warning">'.$row['nitcedula_emp'].'</td>
                      <td class="success">'.$row['nombre_emp'].'</td>
                      <td class="success">'.$row['nombreubi_emp'].' - '.$row['direccionubi_emp'].' - '.$row['nombre_mun'].'</td>
                      <td class="success">'.$row['nombre_forE'].$row['numcontrato_emp'].'</td>
                      <td class="success">'.$row['descripcion_sop'].'</td>
                      <td class="success">'.$row['solucion_sop'].'</td>
                       

                  </tr>';
        
    }
    while($row=mysqli_fetch_array($queryPersonal)){
            echo '<tr> '
                     .'<td>P</td>
                      <td class="warning">'.$row['cedula_cli'].'</td>
                      <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                      <td class="success">'.$row['nombre_ubi'].' - '.$row['direccion_ubi'].' - '.$row['nombre_mun'].'</td>
                      <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
                      <td class="success">'.$row['descripcion_sop'].'</td>
                      <td class="success">'.$row['solucion_sop'].'</td>
                      

                  </tr>';
        
    }
    echo 
        '</table>';
   
 }else{
   echo ' <h2 style="color:green;"><?php echo $titulo; ?></h2><br><center><h3 color="red">No Se han encontrado resultados</h3>';
}

$_SESSION['datosF']=$datosF;
?>