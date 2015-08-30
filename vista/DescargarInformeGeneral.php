<?php
set_time_limit(120);
require_once("dompdf/dompdf_config.inc.php");
    $generarPor=$_GET['generarpor'];
    $busqueda=$_GET['busqueda'];

include "../modelo/Datos.php";
 $datosF=new Datos();
session_start();
    if(!empty($_SESSION["datosF"])){
        $datosF=$_SESSION["datosF"];
    }

    $datosF->generarPor=$generarPor;
    $datosF->busqueda=$busqueda;
    $datosF->sumAbiertas=0;
    $datosF->sumCerradas=0;
     $numPagina="";

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
$numPaginaEmpr="";
$numPaginaPers="";
 $queryPersonal      =   $datosF->InformeGeneralPerso($condicionesPER,$numPaginaPers);
 $queryEmpresarial   =   $datosF->InformeGeneralEmpre($condicionesEMP,$numPaginaEmpr);
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
                        border-top  :   4px solid #aabcfe; 
                     }
                     #ini{
                        width       :   240px;
                     }
              </style>
              
          </head>
          <body>
                  
                    <h3 style="color:green;">'.$titulo.'</h3><br>
                   <table border="1" id="ini">
                    <tr>
                      <th class="info">Total de clientes </th>
                      <td class="info">'.$datosF->sumClientes.'</td>
                    </tr>
                     <tr>
                      <th class="info">Clientes Personales </th>
                      <td class="info">'.$datosF->sumClientesPer.'</th>
                    </tr>
                     <tr>
                      <th class="info">Clientes Empresariales </td>
                      <td class="info">'.$datosF->sumClientesEmpre.'</td>
                    </tr>
                   </table><br><br>

                 <table  border="1">
                                <tr>
                                <th>#</th>
                                  <th >Nit/Cedula</th>
                                  <th >Nombre</th>
                                  <th >Ubicacion</th>
                                  <th >Contrato</th>
                                 </tr>';
          $contar=0;

        while($row=mysqli_fetch_array($queryEmpresarial)){
            $contar=$contar+1;
             
               $html=$html.'<tr> 
                            <td>'.$contar.'.E</td>
                          <td class="warning">'.$row['nitcedula_emp'].'</td>
                          <td class="success">'.$row['nombre_emp'].'</td>
                          <td class="success">'.$row['nombreubi_emp'].' - '.$row['direccionubi_emp'].' - '.$row['nombre_mun'].'</td>
                          <td class="success">'.$row['nombre_forE'].$row['numcontrato_emp'].'</td>
                         </tr>';



        }
   
        while($row=mysqli_fetch_array($queryPersonal)){
              $contar=$contar+1;
            if($contar <= 150){
                $html=$html.'<tr> 
                                 <td>'.$contar.'.P</td>
                              <td class="warning">'.$row['cedula_cli'].'</td>
                              <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                              <td class="success">'.$row['nombre_ubi'].' - '.$row['direccion_ubi'].' - '.$row['nombre_mun'].'</td>
                              <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
                             </tr>';


            }else{
                break;
                break;break;
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
