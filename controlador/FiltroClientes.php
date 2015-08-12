<?php
include "../modelo/Datos.php";
$clase=new Datos();
$palabra=$_POST['palabra'];


$num_contrato="";
$cod_contrato="";
$nombre="";
$apellido="";
$resta2=1;
$resta=1;
$var="";
$numerocedula=intval($palabra);
if($numerocedula == 0){
    for($i=1;$i < strlen($palabra);$i++){
    
        if($palabra[$i] == " "){
            $nombre = substr($palabra,0,$i);
            $inicio=$i-strlen($palabra);
            $inicio=$inicio+1;
            $apellido = substr($palabra,$inicio);
            $var=1;
            break;
            }
            else{

              $numero="01234567890";
                for($j=1;$j < strlen($numero);$j++){
                    if($palabra[$i] == $numero[$j]){
                        if($resta == 1){
                            $print=$i;
                        }
                        $cod_contrato = substr($palabra,0,$print);
                        $resta=$resta+1;
                        $num_contrato=$num_contrato.$palabra[$i];
                        $var=2;
                        break;

                    }else{
                                $var=3;
                    }
                 } 
           }
    }
}
else{
    $var=3;
}


if($var == 1){
        $query2=$clase->FiltroClientesPersonalesNombre($nombre,$apellido);
        $query=$clase->FiltroClientesEmpresariales($palabra);
    
}else{
    if($var == 2){
        $query2=$clase->FiltroClientesPersonalesContrato($cod_contrato,$num_contrato);
        $query=$clase->FiltroClientesEmpresarialesContrato($cod_contrato,$num_contrato);
        
    }else{
        $query2=$clase->FiltroClientesPersonales($palabra);
         $query=$clase->FiltroClientesEmpresariales($palabra);
    }
}


if($var == 2){
    if(mysqli_num_rows($query) > 0){
        echo "true+";
        echo '<table class="table table-bordered">
                        <tr>
                          <td></td>
                          <td class="info">Nit/Cedula</td>
                          <td class="info">Nombre</td>
                          <td class="info">email</td>
                          <td class="info">Contrato</td>

                        </tr>';
       $num=1;
        while($row=mysqli_fetch_array($query)){
            if($num != 13){
                echo '<tr> '
                . '<td>E</td>
                    <td class="warning">'.$row['nitcedula_emp'].'</td>
                            <td class="success">'.$row['nombre_emp'].'</td>
                            <td class="success">'.$row['email_emp'].'</td>
                            <td class="success">'.$row['nombre_forE'].$row['numcontrato_emp'].'</td>
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
                                    <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
                                    <td>

                                       <button type="button" onclick="Incidencias('.$row['cod_cli'].',1)" ><span class="glyphicon glyphicon-eye-open"></span></button></td>
                               </tr>';
                     }
                   $num=$num+1;
                }
        echo '</table>';
    }else{
       if(mysqli_num_rows($query2) > 0){
           echo "true+";
                echo '<table class="table table-bordered">
                                <tr>
                                  <td></td>
                                  <td class="info">Ni/Cedula</td>
                                  <td class="info">Nombre</td>
                                  <td class="info">email</td>
                                  <td class="info">Contrato</td>

                                </tr>';
               $num=1;
                while($row=mysqli_fetch_array($query2)){
                    echo '<tr> '
                    . '<td>P</td>
                        <td class="warning">'.$row['cedula_cli'].'</td>
                                <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                                <td class="success">'.$row['email_cli'].'</td>
                                <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
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
}else{
    
    if(mysqli_num_rows($query) > 0){
        echo "true+";
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
           echo "true+";
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
}
?>