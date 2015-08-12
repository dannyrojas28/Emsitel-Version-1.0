<?php

include "../modelo/Datos.php";
$clase=new Datos();
$query=$clase->Consulta25ClientesPersonales();

if(mysqli_num_rows($query) > 0){
    echo '<table class="table table-bordered">
                    <tr>
                      <td></td>
                      <td class="info">Cedula</td>
                      <td class="info">Nombre</td>
                      <td class="info">email</td>
                      <td class="info">Municipio</td>
                     
                    </tr>';
   $num=1;
    while($row=mysqli_fetch_array($query)){
        echo '<tr> '
        . '<td>'.$num.'</td><td class="warning">'.$row['cedula_cli'].'</td>
                    <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                    <td class="success">'.$row['email_cli'].'</td>
                    <td class="success">'.$row['nombre_mun'].'</td>
                    <td>
                       
                       <button type="button" onclick="ActualizarClientePersonal('.$row['cod_cli'].')" ><span class="glyphicon glyphicon-pencil"></span></button></td>
               </tr>';
       $num=$num+1;
    }
    echo '</table>';
}else{
    echo "<br><center><span class='glyphicon glyphicon-upload'>no se han encontrado Resultados</span></center><br>";
    
}
