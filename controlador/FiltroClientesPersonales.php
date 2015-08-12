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
            $var=2;
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
                        $num_contrato.=$palabra[$i];
                        $var=1;
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
    $query=$clase->FiltroClientesPersonalesContrato($cod_contrato,$num_contrato);
}else{
    if($var == 2){
        $query=$clase->FiltroClientesPersonalesNombre($nombre,$apellido);
    }else{
        $query=$clase->FiltroClientesPersonales($palabra);
    }
}


   
if($var == 2 or $var == 3){
    if(mysqli_num_rows($query) > 0){

            echo "true+";
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
                echo '<tr>
                       <td>'.$num.'</td><td class="warning">'.$row['cedula_cli'].'</td>
                            <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                            <td class="success">'.$row['email_cli'].'</td>
                            <td class="success">'.$row['nombre_mun'].'</td>
                            <td><button type="button" onclick="ActualizarClientePersonal('.$row['cod_cli'].')"><span class="glyphicon glyphicon-pencil"></span></button></td>
                       </tr>';
               $num=$num+1;
            }
            echo '</table>';
        }
}
  else{
    if(mysqli_num_rows($query) > 0){
        echo "true+";
        echo '<table class="table table-bordered">
                        <tr>
                          <td></td>
                          <td class="info">Cedula</td>
                          <td class="info">Nombre</td>
                          <td class="info">email</td>
                          <td class="info">Contrato</td>

                        </tr>';
       $num=1;
        while($row=mysqli_fetch_array($query)){
            echo '<tr> '
            . '<td>'.$num.'</td><td class="warning">'.$row['cedula_cli'].'</td>
                        <td class="success">'.$row['nombre1_cli'].' '.$row['apellido1_cli'].'</td>
                        <td class="success">'.$row['email_cli'].'</td>
                        <td class="success">'.$row['nombre_for'].$row['numcontrato_ser'].'</td>
                        <td>

                           <button type="button" onclick="ActualizarClientePersonal('.$row['cod_cli'].')"><span class="glyphicon glyphicon-pencil"></span></button></td>
                   </tr>';
           $num=$num+1;
        }
        echo '</table>';
    }
  }
        
              