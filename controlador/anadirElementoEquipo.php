<?php 
include ('../modelo/Datos.php'); 
$datosF=new Datos();
$aumentaipeq=$_POST['aumentaipeq'];
$aumentaipeq=$aumentaipeq + 1;
$query2=$datosF->BD_Elementos(); 
 echo '<div class="form-group">  <br>
                        <div class="col-xs-6">
                            <label id="examplePass">Elemento # '.$aumentaipeq.' </label><br>
                             <select  id="elementoE'.$aumentaipeq.'"  class="form-control"  name="elementoE'.$aumentaipeq.'">
                                            <option value="0">SeleccioneElemento</option>
                                            <div class="form-group">';
                                    while($row=mysqli_fetch_array($query2)){
                                                    if($row['cod_ele'] != 0){
                                                            echo '<option value="'.$row['cod_ele'].'">'.$row['nombre_ele'].'</option>';
                                                        }
                                                }
    echo        '</select>
                </div>
                      <div class="col-xs-6">
                        <label id="examplePass">Mac/Serial</label><br> 
                            <input type="text" class="form-control"  name="direccionmac'.$aumentaipeq.'"id="direccioncmac'.$aumentaipeq.'" value="0"> 
                        <br>
                    </div>
                
                    
                    <div class="col-xs-12 ">
                        <label id="examplePass">Descripcion</label>
                        <input type="text" class="form-control" placeholder="descripcion serial" id="descripcionserial'.$aumentaipeq.'" name="descripcionserial'.$aumentaipeq.'" >
                        <br>
                     </div>
                </div>';
?>
                        
                    