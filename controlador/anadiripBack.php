<?php 
include ('../modelo/Datos.php'); 
$datosF=new Datos();
$aumentaip=$_POST['aumentaipb'];
$aumentaip=$aumentaip + 1;
$query2=$datosF->BD_IpBakbone(); 
 echo '<div class="form-group">
                <br>
          <div class="col-xs-7">
           <label id="examplePass">Direccion Ip #'.$aumentaip.'  </label>
            <div class="input-group">
                <select  id="sm"  class="form-control"  name="rangoipB'.$aumentaip.'">
                    <option value="0">..Rango IP..</option>';

    while($row=mysqli_fetch_array($query2)){ 

        if($row["cod_ipb"] != 0){
            echo '<option value="'.$row['formato_ipb'].'">'.$row['formato_ipb'].'</option>';
        } 
    } 
    echo        '</select>
                      <input type="number" class="form-control input-group-addon"  maxlength="3" onkeyup="validateIp(\'direccionIp'.$aumentaip.'\',\'descripcionIp'.$aumentaip.'\')"name="direccionIp'.$aumentaip.'" id="sm2" value="0"> 
             </div>
           </div>
           <div class="col-xs-5">
                <label id="examplePass">Descripcion</label><br>
                 <input type="text" class="form-control"  placeholder="Descripcion Ip 1" name="descripcionIp'.$aumentaip.'"id="descripcionIp'.$aumentaip.'" > 
                 <br>
          </div>
       
       </div>';
?>
