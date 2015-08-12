<?php

include "../modelo/Datos.php";
$clase=new Datos();
$palabra=$_POST['palabra'];
$resta=1;
$num_contrato="";
$cod_contrato="";
$nitcedula=intval($palabra);
if($nitcedula == 0){
    for($i=1;$i < strlen($palabra);$i++){
        $numero="01234567890";
             for($j=1;$j < strlen($numero);$j++){ 
                if($palabra[$i] == $numero[$j]){
                   
                    if($resta == 1){
                         $print=$i;
                    }
                    $cod_contrato = substr($palabra,0,$print);
                   $resta=$resta+1;
                   $num_contrato=$num_contrato.$palabra[$i];
                   $var=1;
                   break;
                }else{
                     $var=2;
                  }
         }
    }
}else{
     $var=2;
}
if($var == 1){
    $query=$clase->FiltroClientesEmpresarialesContrato($cod_contrato,$num_contrato);
}else{
        $query=$clase->FiltroClientesEmpresariales($palabra);
    
}
if($var == 2){
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

                           <button type="button" onclick="ActualizarClienteEmpresarial('.$row['cod_emp'].')"><span class="glyphicon glyphicon-pencil"></span></button></td>
                   </tr>';
           $num=$num+1;
        }
        echo '</table>';
    }else{
       echo "<br><center>no se han encontrado Resultados</center><br>";
    }
}else{
    if(mysqli_num_rows($query) > 0){
        echo '<table class="table table-bordered">
                        <tr>
                          <td></td>
                          <td class="info">Nit/Cedula</td>
                          <td class="info">Nombre Empresa</td>
                          <td class="info">email</td>
                          <td class="info">Contrato</td>

                        </tr>';
       $num=1;
        while($row=mysqli_fetch_array($query)){
            echo '<tr> '
            . '<td>'.$num.'</td><td class="warning">'.$row['nitcedula_emp'].'</td>
                        <td class="success">'.$row['nombre_emp'].'</td>
                        <td class="success">'.$row['email_emp'].'</td>
                        <td class="success">'.$row['nombre_forE'].$row['numcontrato_emp'].'</td>
                        <td>

                           <button type="button" onclick="ActualizarClienteEmpresarial('.$row['cod_emp'].')"><span class="glyphicon glyphicon-pencil"></span></button></td>
                   </tr>';
           $num=$num+1;
        }
        echo '</table>';
    }else{
       echo "<br><center>no se han encontrado Resultados</center><br>";
    }
}
