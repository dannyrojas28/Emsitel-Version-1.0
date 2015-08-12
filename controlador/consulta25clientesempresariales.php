<?php

include "../modelo/Datos.php";
$clase=new Datos();
$query=$clase->Consulta25ClientesEmpresariales();

if(mysqli_num_rows($query) > 0){
    echo '<table class="table table-bordered">
                    <tr>
                      <td></td>
                      <td class="info">Nit/Cedula</td>
                      <td class="info">Nombre Empresa</td>
                      <td class="info">email</td>
                      <td class="info">Municipio</td>
                     
                    </tr>';
   $num=1;
    while($row=mysqli_fetch_array($query)){
        echo '<tr> '
        . '<td>'.$num.'</td><td class="warning">'.$row['nitcedula_emp'].'</td>
                    <td class="success">'.$row['nombre_emp'].'</td>
                    <td class="success">'.$row['email_emp'].'</td>
                    <td class="success">'.$row['nombre_mun'].'</td>
                    <td>
                       
                       <button type="button" onclick="ActualizarClienteEmpresarial('.$row['cod_emp'].')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
               </tr>';
       $num=$num+1;
    }
    echo '</table>';
}else{
    echo "<br><center><span class='glyphicon glyphicon-upload'>no se han encontrado Resultados</span></center><br>";
    
}
?>