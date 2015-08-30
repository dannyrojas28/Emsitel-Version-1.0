<?php
include "../modelo/Datos.php";
$datosF=new Datos();
$html="";
$nodo=$_POST['nodo'];
$numero=$_POST['numero'];
$query2=$datosF->BD_Antena($nodo);
$html=' <select class="form-control"  id="antena" name="antena" >
                            <option value="0">Seleccione el Tipo</option>';
while($row=mysqli_fetch_array($query2)){
   if($row['cod_ant'] != 0){
       if($numero == $row['cod_ant']){
            $html=$html.'<option value="'.$row['cod_ant'].'" selected>'.$row['nombre_ant'].'</option>';
        }else{
            $html=$html.'<option value="'.$row['cod_ant'].'" >'.$row['nombre_ant'].'</option>';
       }
   }

}
$html=$html.'</select>';
echo $html;
?>