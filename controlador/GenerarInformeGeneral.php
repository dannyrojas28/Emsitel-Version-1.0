 <?php
include "../modelo/Datos.php";
    $datosF =   new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF =   $_SESSION['datosF'];
}
if(!empty($_POST['generarpor'])){
    $datosF->generarPor =   $_POST['generarpor'];
    $datosF->busqueda   =   $_POST['busqueda'];
    $datosF->igualar    =   "";
}
$datosF->sumClientesEmpre   = 0;
$datosF->sumClientesPer     = 0;
$datosF->sumClientes        = 0;   
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
switch ($datosF->generarPor){
     case 1:
        $query2=$datosF->BD_Nodo();
             while($row=mysqli_fetch_array($query2)){
                 if($row['cod_nod'] != 0){
                     if($datosF->busqueda == $row['cod_nod']){
                         $name=$row['nombre_nod'];
                      }
                  }
             }
            $titulo="Clientes por Nodo De: ".$name;
            $tabla='detalleservicio_personal,tiposervicio_personal,ubicacion_servicio_personal,datos_clientes_personales';
            $cod='COUNT(cod_det) AS numero';
            $condiciones='nodo_det='.$datosF->busqueda.' and detalleservicio_personal.cod_tiposervicio=tiposervicio_personal.cod_ser and tiposervicio_personal.cod_ubicacion=ubicacion_servicio_personal.cod_ubi  group by cod_persona';
            $queryContar[1]=$datosF->NumeroClientes($cod,$tabla,$condiciones);
            $tabla="detalleservicio_empresarial,tiposervicio_empresarial,ubicacion_servicio_empresarial,datos_clientes_empresariales";
            $cod="COUNT(cod_det_emp)AS numero";
            $condiciones="nodo_emp=".$datosF->busqueda.' and detalleservicio_empresarial.cod_servicio_emp=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.cod_ubicacion_emp=ubicacion_servicio_empresarial.cod_ubi_emp  group by cod_empresa ';
            $queryContar[2]=$datosF->NumeroClientes($cod,$tabla,$condiciones);
            $condicionesEMP="and nodo_emp=".$datosF->busqueda;
            $condicionesPER="and nodo_det=".$datosF->busqueda;
        break;
    
    case 2:
       $query2=$datosF->BD_Municipios();
             while($row=mysqli_fetch_array($query2)){
                 if($row['cod_mun'] != 0){
                     if($datosF->busqueda == $row['cod_mun']){
                         $name=$row['nombre_mun'];
                      }
                  }
             }
            $titulo="Clientes por Municipo De: ".$name;
            $tabla='detalleservicio_personal,tiposervicio_personal,ubicacion_servicio_personal,datos_clientes_personales';
            $cod='*';
            $condiciones=' detalleservicio_personal.cod_tiposervicio=tiposervicio_personal.cod_ser and tiposervicio_personal.cod_ubicacion=ubicacion_servicio_personal.cod_ubi and municipio_ubi='.$datosF->busqueda.' group by cod_persona';
            $queryContar[1]=$datosF->NumeroClientes($cod,$tabla,$condiciones);
            $tabla="detalleservicio_empresarial,tiposervicio_empresarial,ubicacion_servicio_empresarial,datos_clientes_empresariales";
            $cod="*";
            $condiciones='detalleservicio_empresarial.cod_servicio_emp=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.cod_ubicacion_emp=ubicacion_servicio_empresarial.cod_ubi_emp and municipioubi_emp='.$datosF->busqueda.'  group by cod_empresa ';
            $queryContar[2]=$datosF->NumeroClientes($cod,$tabla,$condiciones);
             $condicionesEMP="and municipioubi_emp=".$datosF->busqueda;
            $condicionesPER="and municipio_ubi=".$datosF->busqueda;
    break;
    
    case 3: 
        $query2=$datosF->BD_EstadoServicio();
             while($row=mysqli_fetch_array($query2)){
                 if($row['cod_est'] != 0){
                     if($datosF->busqueda == $row['cod_est']){
                         $name=$row['nombre_est'];
                      }
                  }
             }
            $titulo="Clientes En Estado : ".$name;
            $tabla='detalleservicio_personal,tiposervicio_personal,ubicacion_servicio_personal,datos_clientes_personales';
            $cod='*';
            $condiciones=' detalleservicio_personal.cod_tiposervicio=tiposervicio_personal.cod_ser and tiposervicio_personal.cod_ubicacion=ubicacion_servicio_personal.cod_ubi and estadoservicio='.$datosF->busqueda.' group by cod_persona';
            $queryContar[1]=$datosF->NumeroClientes($cod,$tabla,$condiciones);
            $tabla="detalleservicio_empresarial,tiposervicio_empresarial,ubicacion_servicio_empresarial,datos_clientes_empresariales";
            $cod="*";
            $condiciones='detalleservicio_empresarial.cod_servicio_emp=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.cod_ubicacion_emp=ubicacion_servicio_empresarial.cod_ubi_emp and estado_servicio_emp='.$datosF->busqueda.'  group by cod_empresa ';
            $queryContar[2]=$datosF->NumeroClientes($cod,$tabla,$condiciones);
             $condicionesEMP="and estado_servicio_emp=".$datosF->busqueda;
            $condicionesPER="and estadoservicio=".$datosF->busqueda;
    break;
    
    
       
} 

 for($i=1;$i <=2;$i++){
     $row=mysqli_num_rows($queryContar[$i]);
         $datosF->sumClientes=$datosF->sumClientesPer+$row;
         if($i == 1){
             $datosF->sumClientesPer=$row;
             
         }else{
             $datosF->sumClientesEmpre=$row;
         }
     
 }

if($datosF->sumClientes != 0){

    $comparar=$num+25;
     if($datosF->sumClientesEmpre >= $comparar){
           $datosF->numeroEmpresas=$datosF->sumClientesEmpre - $comparar;
           $datosF->emo=$datosF->numeroEmpresas;
           $numPaginaPers='limit 0,0';
           $numPeraz=0;
       }else{
           if($datosF->sumClientesEmpre < 25){
               if(empty($datosF->igualar)){
                   
                   $numEmpr=$datosF->sumClientesEmpre;
                   $numPaginaEmpr='limit '.$numEmpr.'25';
                   $datosF->igualar="sdsdsd";
                   $numPer=25 - $numEmpr;
                   $numPaginaPers='limit 0,'.$numPer;
                   $numPeraz=$numPer+1;
                   $datosF->emo=0;
               }else{
                   $datosF->emo=0;
                   $numPaginaPers='limit '. $numPer.',25';
                   $numPaginaEmpr="limit 0,0";
                   $numPeraz=$numPer+25;
               }
           }else{
               if($datosF->numeroEmpresas != 0){
                   $numPaginaEmpr='limit '.$num.',25';
                   $numPer=25 - $datosF->numeroEmpresas;
                   $numPaginaPers='limit 0,'.$numPer;
                   $numPeraz=$numPer+1;
                   $datosF->emo=$datosF->numeroEmpresas;
                   $datosF->numeroEmpresas=0;
               }else{
                   $numPaginaEmpr="limit 0,0";
                   $numPaginaPers='limit '. $numPer.',25';
                  $numPeraz=$numPer+25;
                   
                   
               }
           }
       }
    
        $queryPersonal      =   $datosF->InformeGeneralPerso($condicionesPER,$numPaginaPers);
        $queryEmpresarial   =   $datosF->InformeGeneralEmpre($condicionesEMP,$numPaginaEmpr);
    ?>     
<div class="col-xs-12">
        <a   onclick="DowloandInformeGeneral('')" class="float" id="cursor"> <span class="glyphicon glyphicon-save"> Descargar (.pdf)</span></a>
<br>
           
            <?php 
    
            echo '<h3 style="color:green;">'.$titulo.'</h3><br>';

            echo '<div class="col-xs-3"> <table class="table table-bordered">
                    <tr>
                      <td class="info">Total de clientes </td>
                      <td class="info">'.$datosF->sumClientes.'</td>
                    </tr>
                     <tr>
                      <td class="info">Clientes Personales </td>
                      <td class="info">'.$datosF->sumClientesPer.'</td>
                    </tr>
                     <tr>
                      <td class="info">Clientes Empresariales </td>
                      <td class="info">'.$datosF->sumClientesEmpre.'</td>
                    </tr>
                   </table>
                </div>';
            ?>
 </div>
<div class="col-xs-12">
    <?php
    if($datosF->sumClientes > 25){
       $numeroPaginas=1;
        $sum=0;
        for($i=0;$i < $datosF->sumClientes;$i++){
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
                    <a  onclick="PrevInforme('controlador/GenerarInformeGeneral.php',<?php echo $numPersona=$numPeraz; ?>,<?php echo $numeroReg=$num+25;?>,<?php echo $paginas=$pagina+1;?>,<?php echo $gt=2?> )" class="float" style="text-decoration:none" id="cursor">  Siguiente<span class="glyphicon glyphicon-chevron-right"> </span> </a> 
    <?php  }
         echo " <p class='float'>&nbsp; &nbsp; &nbsp; Pagina ".$pagina." de ".$numeroPaginas." &nbsp; &nbsp; &nbsp; </p>";
        if($pagina != 1){
      ?>
           <a  onclick="PrevInforme('controlador/GenerarInformeGeneral.php',<?php echo $numPersona=$numPeraz - 50; ?>,<?php  echo $numeroReg=$num-25;?>,<?php echo $paginas=$pagina-1;?>,<?php echo $gt=1;?>)" class="float" style="text-decoration:none" id="cursor"> <span class="glyphicon glyphicon-chevron-left">  </span> Atras   </a>
           
    <?php  }
    ?>
      
</div>
<?php
echo '<table class="table table-bordered">
                    <tr>
                      <td>#</td>
                      <td class="info">Nit/Cedula</td>
                      <td class="info">Nombre</td>
                      <td class="info">Ubicacion</td>
                      <td class="info">Contrato</td>
                     
                    </tr>';
    
        while($row=mysqli_fetch_array($queryEmpresarial)){
            $datosF->contar=$datosF->contar+1;
           
                echo '<tr>
                          <td>'.$datosF->contar.'.E</td>
                          <td class="success">'.$row['nitcedula_emp'].'</td>
                          <td class="success">'.$row['nombre_emp'].'</td>
                          <td class="success">'.$row['nombreubi_emp'].' - '.$row['direccionubi_emp'].' - '.$row['nombre_mun'].'</td>
                          <td class="success">'.$row['nombre_forE'].$row['numcontrato_emp'].'</td>
                            </tr>';

        }
        while($row=mysqli_fetch_array($queryPersonal)){
            $datosF->contar=$datosF->contar+1;
           
                echo '<tr> 
                <td>'.$datosF->contar.'.P</td>
                          <td class="success">'.$row['cedula_cli'].'</td>
                          <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                          <td class="success">'.$row['nombre_ubi'].' - '.$row['direccion_ubi'].' - '.$row['nombre_mun'].'</td>
                          <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
                          
                            </tr>';

        }
    echo 
        '</table>';
}else{
      echo ' <h2 style="color:green;"><?php echo $titulo; ?></h2><br><center><h3 color="red">No Se han encontrado resultados</h3>';
}
$_SESSION['datosF']=$datosF;
?>