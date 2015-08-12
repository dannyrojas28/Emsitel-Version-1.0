<?php

include "../modelo/Datos.php";
$clase=new Datos();
$query=$clase->Consulta25ClientesEmpresariales();
$query2=$clase->Consulta25ClientesPersonales();

if(mysqli_num_rows($query) > 0){
    echo '<table class="table table-bordered">
                    <tr>
                      <td></td>
                      <td class="info">Nit/Cedula</td>
                      <td class="info">Nombre</td>
                      <td class="info">email</td>
                      <td class="info">Municipio</td>
                     
                    </tr>';
   $num=1;
    while($row=mysqli_fetch_array($query)){
        if($num != 13){
            echo '<tr> '
            . '<td>E</td>
                <td class="warning">'.$row['nitcedula_emp'].'</td>
                        <td class="success">'.$row['nombre_emp'].'</td>
                        <td class="success">'.$row['email_emp'].'</td>
                        <td class="success">'.$row['nombre_mun'].'</td>
                        <td>

                           <button type="button" onclick="Incidencias('.$row['cod_emp'].',2)" ><span class="glyphicon glyphicon-eye-open"></span></button></td>
                   </tr>';
        }
       $num=$num+1;
    }
     $num=1;
            while($row=mysqli_fetch_array($query2)){
                 if($num != 12){
                    echo '<tr> '
                    . '<td>P</td>
                        <td class="warning">'.$row['cedula_cli'].'</td>
                                <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                                <td class="success">'.$row['email_cli'].'</td>
                                <td class="success">'.$row['nombre_mun'].'</td>
                                <td>

                                   <button type="button" onclick="Incidencias('.$row['cod_cli'].',1)" ><span class="glyphicon glyphicon-eye-open"></span></button></td>
                           </tr>';
                 }
               $num=$num+1;
            }
    echo '</table>';
}else{
   if(mysqli_num_rows($query2) > 0){
            echo '<table class="table table-bordered">
                            <tr>
                              <td></td>
                              <td class="info">Ni/Cedula</td>
                              <td class="info">Nombre</td>
                              <td class="info">email</td>
                              <td class="info">Municipio</td>

                            </tr>';
           $num=1;
            while($row=mysqli_fetch_array($query2)){
                echo '<tr> '
                . '<td>P</td>
                    <td class="warning">'.$row['cedula_cli'].'</td>
                            <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                            <td class="success">'.$row['email_cli'].'</td>
                            <td class="success">'.$row['nombre_mun'].'</td>
                            <td>

                               <button type="button" onclick="Incidencias('.$row['cod_cli'].',1)" ><span class="glyphicon glyphicon-eye-open"></span></button></td>
                       </tr>';
               $num=$num+1;
            }
            echo '</table>';
        }else{
            echo "<br><center><span class='glyphicon glyphicon-upload'>no se han encontrado Resultados</span></center><br>";

        }
    
}



?>