<?php
set_time_limit(120);
require_once("dompdf/dompdf_config.inc.php");
    $fechaInicio=$_GET['fechainicio'];
    $fechaFin=$_GET['fechafin'];
    $generarPor=$_GET['generarpor'];
    $busqueda=$_GET['busqueda'];

include "../modelo/Datos.php";
 $datosF=new Datos();
session_start();
    if(!empty($_SESSION["datosF"])){
        $datosF=$_SESSION["datosF"];
    }
$datosF->fechaInicio=$fechaInicio;
    $datosF->fechaFin=$fechaFin;
    $datosF->generarPor=$generarPor;
    $datosF->busqueda=$busqueda;
    $datosF->sumAbiertas=0;
    $datosF->sumCerradas=0;
     $numPagina="";
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
        $tetxo2=" and Incidencias_Personales.cod_servicio=tiposervicio_personal.cod_ser and tiposervicio_personal.tiposervicio=".$datosF->busqueda.' group by SoportesIncidenciasPersonales.cod_inc';
        for($i=1;$i <= 2;$i++){
           $queryA[$i]=$datosF->NumeroIncidenciasAbiertas($tablaIni,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxo);
           $queryC[$i]=$datosF->NumeroIncidenciasCerradas($tablaIni,$tablasoporte,$tabla,$datosF->fechaInicio,$datosF->fechaFin,$tetxo2);
           $tablasoporte="SoportesIncidenciasEmpresas";
           $tablaIni="Incidencias_Empresariales";
           $tabla=",tiposervicio_empresarial";
           $tetxo="and Incidencias_Empresariales.cod_servicio=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.tipo_servicio_emp=".$datosF->busqueda;
           $tetxo2="and Incidencias_Empresariales.cod_servicio=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.tipo_servicio_emp=".$datosF->busqueda.' group by SoportesIncidenciasEmpresas.cod_inc';
        }
        $datosF->fechaFinD=$datosF->fechaFin;
        $tetxoE="and tiposervicio_empresarial.tipo_servicio_emp=".$datosF->busqueda;
        $tetxoP="and tiposervicio_personal.tiposervicio=".$datosF->busqueda;
            break;
        case 3:
             $titulo="Total De Incidencias Por Creador ".$datosF->busqueda." Del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
               $tablasoporte="SoportesIncidenciasPersonales";
                $tablaIni="Incidencias_Personales";
                $tabla="";
                $tetxo="and Incidencias_Personales.creador_inc='".$datosF->busqueda."'";
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
             $titulo="Total De Incidencias Por Creador ".$name." Del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
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


            $queryPersonal[1]=$datosF->InformeTotalInciPerso($numPagina,$datosF->fechaInicio,$datosF->fechaFinD,$tetxoP);
            $queryEmpresarial[1]=$datosF->InformeTotalInciEmpre($numPagina,$datosF->fechaInicio,$datosF->fechaFinD,$tetxoE);
            $queryPersonal[2]=$datosF->InformeTotalInciCerraPerso($numPagina,$datosF->fechaInicio,$datosF->fechaFin,$tetxoP);
            $queryEmpresarial[2]=$datosF->InformeTotalInciCerraEmpre($numPagina,$datosF->fechaInicio,$datosF->fechaFin,$tetxoE);
if($datosF->generarPor != 3){
    for($i=1;$i <= 2;$i++){    
        while($row=mysqli_fetch_array($queryA[$i])){
                 $datosF->sumAbiertas=$datosF->sumAbiertas+$row["numero"];
         }
         $sumaCerradas=mysqli_num_rows($queryC[$i]);
         $datosF->sumCerradas=$datosF->sumCerradas + $sumaCerradas;
         
    }
}else{
    $datosF->sumAbiertas=0;
     for($i=1;$i <= 2;$i++){
           while($row=mysqli_fetch_array($queryA[$i])){
                 $datosF->sumAbiertas=$datosF->sumAbiertas+$row["numero"];
         }

        while($row=mysqli_fetch_array($queryC[$i])){
                $datosF->sumCerradas=$datosF->sumCerradas+$row["numero"];
        }
     }
    
}

date_default_timezone_set('America/Bogota');
 
 $html='

 <html>
          <head>
         <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <style>
                table{
                        font-family :    "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
                        font-size   :     12px;       
                        width       :     750px;     
                        border-collapse:  collapse;
                        border-bottom : 1px solid red;
                }
                th {     
                        font-size   :      13px;     
                        font-weight :    normal;     
                        padding:        8px;     
                        background  :     #CBE9F7;
                        border-top  :   4px solid #aabcfe;   
                        border-bottom:  4px solid #aabcfe; 
                        color: #039 ; 
                   }
                   td {    
                        padding     :   8px;     
                        background  :   #CBF7E8;     
                        border-bottom:  4px solid #aabcfe; 
                        color       :   #669 ;    
                        border-top  :   1px solid transparent; 
                     }
                     #ini{
                        width       :   240px;
                     }
              </style>
              
          </head>
          <body>
                  <div class="col-xs-12">

                     <h3 style="color:green;">'.$titulo.'</h3><br>
                     <table id="ini" border="1">';
                    if($datosF->generarPor != 4){ 
                        
                     $html=$html. '<tr><th>Inicidencias Creadas</th><td>  '.$datosF->sumAbiertas.'</td></tr>';
                    }
                    if($datosF->generarPor != 3){ 
                       $html=$html.'<tr><th>Inicidencias Cerradas</th><td> '.$datosF->sumCerradas.'</td></tr>';
                    }
                   $html=$html.' </table></div><br><br>

                 <table  border="1">
                                <tr>
                                  <th >Nit/Cedula</th>
                                  <th >Nombre</th>
                                  <th >Ubicacion</th>
                                  <th >Contrato</th>
                                  <th >Descripcion del Problema</th>
                                  <th >Solucion</th>';
                                 if($datosF->generarPor != 4){
                                     $html=$html.'<th class="info">Tecnico</th>';
                                   }else{
                                      $html=$html.'<th class="info">Fecha Inicio</th>
                                             <th class="info">Fecha Cerrar</th>';
                                   }

                               $html=$html.'<th></th></tr>';
          $contar=0;
for($i=1;$i <= 2;$i++){
    
        while($row=mysqli_fetch_array($queryEmpresarial[$i])){
            $contar=$contar+1;
             $query=$datosF->SelectTecnicos();
                         while($rows=mysqli_fetch_array($query)){
                            if($row['responsable_inc'] == $rows['documento_usu']){

                               $Tecnico=$rows['nombre_usu'].' '.$rows['apellido_usu'];
                            }
                         }
               $html=$html.'<tr> 
                          <td class="warning">'.$row['nitcedula_emp'].'</td>
                          <td class="success">'.$row['nombre_emp'].'</td>
                          <td class="success">'.$row['nombreubi_emp'].' - '.$row['direccionubi_emp'].' - '.$row['nombre_mun'].'</td>
                          <td class="success">'.$row['nombre_forE'].$row['numcontrato_emp'].'</td>
                          <td class="success">'.$row['descripcion_sop'].'</td>
                          <td class="success">'.$row['solucion_sop'].'</td> ';
                    
                          if($datosF->generarPor != 4){
                           $html=$html.'<td class="success">'.$Tecnico.'</td>';
                          }else{
                            $html=$html.'<td class="success">'.$row['fechaCrear_sop'].' '.$row['horaCrear_sop'].'</td>
                                  <td class="success">'.$row['fechaCerrar_sop'].' '.$row['horaCerrar_sop'].'</td>';
                          }
                   $html=$html.'<td class="warning">'.$row['cod_inc'].'.E</td></tr>';



        }
    }
    for($i=2;$i >= 1;$i--){
        while($row=mysqli_fetch_array($queryPersonal[$i])){
              $contar=$contar+1;
             $query=$datosF->SelectTecnicos();
                         while($rows=mysqli_fetch_array($query)){
                            if($row['responsable_inc'] == $rows['documento_usu']){

                               $Tecnico=$rows['nombre_usu'].' '.$rows['apellido_usu'];
                            }
                         }
            if($contar <= 150){
                $html=$html.'<tr> 
                          <td class="warning">'.$row['cedula_cli'].'</td>
                          <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                          <td class="success">'.$row['nombre_ubi'].' - '.$row['direccion_ubi'].' - '.$row['nombre_mun'].'</td>
                          <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
                          <td class="success">'.$row['descripcion_sop'].'</td>
                          <td class="success">'.$row['solucion_sop'].'</td>';
                    
                          if($datosF->generarPor != 4){
                           $html=$html.'<td class="success">'.$Tecnico.'</td>';
                          }else{
                            $html=$html.'<td class="success">'.$row['fechaCrear_sop'].' '.$row['horaCrear_sop'].'</td>
                                  <td class="success">'.$row['fechaCerrar_sop'].' '.$row['horaCerrar_sop'].'</td>';
                          }
                   $html=$html.'<td class="warning">'.$row['cod_inc'].'.P</td></tr>';


            }else{
                break;
                break;break;
            }
        }
      
    }

         $html=$html.'<hr> </table>
            </body>
            </html>';


$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
 date_default_timezone_set('America/Bogota');
$fecha=date('Y-m-d');
$dompdf->stream($fecha.".pdf");
