<?php
include "../../modelo/Datos.php";
$datosF=new Datos();
$buscar=$_POST['por'];
$var="";
$Generar="";
switch ($buscar){
  case 1:
    $Generar="<span class='glyphicon glyphicon-tag'></span> Nodo";
    $query=$datosF->BD_Nodo();
        while($row=mysqli_fetch_array($query)){
            if($row['cod_nod'] != 0){
                $var.='<option value="'.$row['cod_nod'].'" >'.$row['nombre_nod'].'</option>';
            }
        }
  break;

  
   case 2:
        $Generar="<span class='glyphicon glyphicon-map-marker'></span> Municipios:";
        $query=$datosF->BD_Municipios();
           while($row=mysqli_fetch_array($query)){
               $name=$row['nombre_mun'];
                $var.='<option value="'.$row['cod_mun'].'">'.$name.'</option>';
               
         }
   break;
    case 3:
           $Generar="<span class='glyphicon glyphicon-adjust'></span> Estado";
            $query2=$datosF->BD_EstadoServicio();
                 while($row=mysqli_fetch_array($query2)){
                         if($row['cod_est'] != 0){
                           $var.='<option value="'.$row['cod_est'].'" >'.$row['nombre_est'].'</option>';
                         }   
                }
           
   break;
}

echo'<label  class="col-xs-2"> '.$Generar.'</label>';
    echo '<div class="col-xs-3">
            <select class="form-control" id="busqueda" name="busqueda"> 
            <option value="0">..Seleccionar..</option>
            '.$var.'
            </select> 
            <span id="span_busqueda"></span>
        </div>';

?>