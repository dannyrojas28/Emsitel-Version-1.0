<?php 
include ('../modelo/Datos.php'); 
$datosF=new Datos();
$aumentaipc=$_POST['aumentaipc'];
$aumentaipc=$aumentaipc + 1;
$query2=$datosF->BD_IpCliente(); 
 echo '<div class="form-group">
                <br>
          <div class="col-xs-7">
           <label id="examplePass">Direccion Ip #'.$aumentaipc.'  </label>
            <div class="input-group">
                <select  id="sm"  class="form-control"  name="rangoipC'.$aumentaipc.'">
                    <option value="0">..Rango IP..</option>';

    while($row=mysqli_fetch_array($query2)){ 

        if($row["cod_ipC"] != 0){
            echo '<option value="'.$row['formato_ipC'].'">'.$row['formato_ipC'].'</option>';
        } 
    } 
    echo        '</select>
                      <input type="number" class="form-control input-group-addon"  maxlength="3" onkeyup="validateIp(\'direccionIpc'.$aumentaipc.'\',\'descripcionIpc'.$aumentaipc.'\')"name="direccionIpc'.$aumentaipc.'" id="sm2" value="0"> 
             </div>
           </div>
           <div class="col-xs-5">
                <label id="examplePass">Descripcion</label><br>
                 <input type="text" class="form-control"  placeholder="Descripcion Ip 1" name="descripcionIpc'.$aumentaipc.'"id="descripcionIpc'.$aumentaipc.'" > 
                 <br>
          </div>
       
       </div>';
?>
