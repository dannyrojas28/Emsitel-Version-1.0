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
   
}
$datosF->sumAbiertas=0;
$datosF->sumCerradas=0;
 $numPagina='';
switch ($datosF->generarPor){
     case 1:
        $titulo="Total De Incidencias del ".$datosF->fechaInicio." al ".$datosF->fechaFin;
        $tablasoporte="SoportesIncidenciasPersonales";
        for($i=1;$i <= 2;$i++){
           $queryA[$i]=$datosF->NumeroIncidenciasAbiertas($tablasoporte,$datosF->fechaInicio,$datosF->fechaFin);
           $queryC[$i]=$datosF->NumeroIncidenciasCerradas($tablasoporte,$datosF->fechaInicio,$datosF->fechaFin);
           $tablasoporte="SoportesIncidenciasEmpresas";
        }
       
        $queryPersonal=$datosF->InformeTotalInciPerso($numPagina,$datosF->fechaInicio,$datosF->fechaFin);
        $queryEmpresarial=$datosF->InformeTotalInciEmpre($numPagina,$datosF->fechaInicio,$datosF->fechaFin);
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
     while($row=mysqli_fetch_array($queryA[$i])){
        if($row['COUNT(cod_sop)'] != 0){
             $datosF->sumAbiertas=$datosF->sumAbiertas+$row['COUNT(cod_sop)'];
             $var=true;
        }
     }
    
    while($row=mysqli_fetch_array($queryC[$i])){
         if($row['COUNT(cod_sop)'] != 0){
            $datosF->sumCerradas=$datosF->sumCerradas+$row['COUNT(cod_sop)'];
           $var=true;
         }
    }
     
}

if($var == true){
  ?>  <div class="col-xs-12">
        <a   onclick="Descargar('controlador/DescargarInforme.php')" class="float" id="cursor"> <span class="glyphicon glyphicon-save"> Descargar (.pdf)</span></a>

            <h2 style="color:green;"><?php echo $titulo; ?></h2><br>
            <p>Inicidencias Creadas  : <?php echo $datosF->sumAbiertas; ?></p>
            <p>Inicidencias Cerradas : <?php echo $datosF->sumCerradas; ?></p><br>

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


// content="text/plain; charset=utf-8"
require_once ('../vista/jpgraph/src/jpgraph.php');
require_once ('../vista/jpgraph/src/jpgraph_pie.php');
require_once ('../vista/jpgraph/src/jpgraph_pie3d.php');

// Some data
$data = array($datosF->sumAbiertas,$datosF->sumCerradas);

// Create the Pie Graph. 
$graph = new PieGraph(350,250);

$theme_class= new VividTheme;
$graph->SetTheme($theme_class);

// Set A title for the plot
$graph->title->Set("A Simple 3D Pie Plot");

// Create
$p1 = new PiePlot3D($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->ExplodeSlice(1);
$graph->Stroke();

?>