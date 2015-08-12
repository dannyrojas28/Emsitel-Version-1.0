<?php
include "../modelo/Datos.php";
$datosF=new Datos();
$cod=$_POST['cod'];
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if($datosF->con == 1){
    $query2=$datosF->VerificarUbicacionesPer($cod);
     $suma=1;
    if(mysqli_num_rows($query2) > 0){
    while($row=mysqli_fetch_array($query2)){
    echo ' <li class="list-group-item list-group-item-warning">
               <label>
                      <input type="radio" name="mychk" onclick="MostrarIncidencias('.$row['cod_ser'].','.$cod.')" id="chd" value="'.$row['cod_ser'].'">
                            '.$row['nombre_tp'].' - '.$row['nombre_est'].' - '.$row['nombre_for'].$row['numcontrato_ser'].'
               </label> 
           </li>';
    $suma=$suma+1;
     }
     $suma=$suma-1;
    }else{
        echo ' <li class="list-group-item list-group-item-warning">No hay Servicios</li>';
    }
}else{
    $query2=$datosF->VerificarUbicacionesEmp($cod);
     $suma=1;
    if(mysqli_num_rows($query2) > 0){
    while($row=mysqli_fetch_array($query2)){
    echo ' <li class="list-group-item list-group-item-warning">
               <label>
                      <input type="radio" name="mychk" id="chd" onclick="MostrarIncidencias('.$row['cod_ser_emp'].','.$cod.')" value="'.$row['cod_ser_emp'].'">
                            '.$row['nombre_tp'].' - '.$row['nombre_est'].' - '.$row['nombre_forE'].$row['numcontrato_emp'].'
               </label> 
           </li>';
    $suma=$suma+1;
     }
     $suma=$suma-1;
    }else{
        echo ' <li class="list-group-item list-group-item-warning">No hay Servicios</li>';
    }
}                   
?>