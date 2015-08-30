<?php
include "../../modelo/Datos.php";
$datosF=new Datos();
$buscar=$_POST['por'];
$var="";
$Generar="";
if($buscar == 2){
    $Generar="<span class='glyphicon glyphicon-list'></span>Servicio";
    $query=$datosF->BD_TiposServicio();
        while($row=mysqli_fetch_array($query)){
            if($row['cod_tp'] != 0){
                $var.='<option value="'.$row['cod_tp'].'" >'.$row['nombre_tp'].'</option>';
            }
        }
}else{
    if($buscar == 3){
        $Generar="<span class='glyphicon glyphicon-user'></span> Creador:";
        $query=$datosF->SelectCreadores();
           while($row=mysqli_fetch_array($query)){
               $name=' '.$row['nombre_usu'].'  '.$row['apellido_usu'];
                $var.='<option value="'.$name.'">'.$name.'</option>';
               
         }
    }else{
       if($buscar == 4){
           $Generar="<span class='glyphicon glyphicon-user'></span> Tecnico";
            $query=$datosF->SelectTecnicos();
               while($row=mysqli_fetch_array($query)){
                      $var.= '<option value="'.$row['documento_usu'].'">'.$row['nombre_usu'].' '.$row['apellido_usu'].'</option>';
                }

      }
    }
}
echo'<label  class="col-xs-2"> '.$Generar.'</label>
        <div class="col-xs-3">
            <select class="form-control" id="busqueda" name="busqueda"> 
            <option value="0">..Seleccionar..</option>
            '.$var.'
            </select> 
            <span id="span_busqueda"></span>
        </div>';
?>