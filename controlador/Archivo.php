<?php
date_default_timezone_set('America/Bogota');
$fecha=$_POST['fechaCre'];
$numero=$_POST['numeroInci'];
$extension="";
$archivoIncidencia="";
$imagen=$_FILES['archivoIncidencia']['name'];
/*
 * To change this template use Tools | Templates.
 */
for($i=strlen($imagen)-1;$i >= 1;$i--){
    if($imagen[$i] == "."){
        $posicion=$i-strlen($imagen);
        $posicion=$posicion+1;
        $extension = substr($imagen,$posicion);
        break;
     }
} 
$extension=strtolower($extension);
$url="";
$archivoIncidencia='/home/codio/workspace/emsitel/vista/archivos/';
$archivoIncidencia=$archivoIncidencia."archivo-".$numero."-".$fecha.".".$extension;
$compara=3;
    if($extension == "jpg" or $extension == "png" or $extension == "gif" or $extension == "jpeg"  ){
        $url='vista/archivos/archivo-'.$numero.'-'.$fecha.'.'.$extension;
        $compara=1;
    }else{
        if($extension == "mp4" or $extension == "avi" or $extension == "mpeg" or $extension == "mov" or $extension == "wmv" or $extension == "rm" or $extension == "flv" ){
            $url="vista/img/icon_mp4.jpg";
            $compara=2;
        }else{
            if($extension == "pdf"){
                $url="vista/img/icon_pdf.png";
            }else{
                if($extension == "xlsx"){
                     $url="vista/img/icon_execel.jpg";
                }else{
                    if($extension == "docx"){
                       $url="vista/img/icon_word.png";
                    }else{
                        if($extension == "txt"){
                             $url="vista/img/icon_txt.png";
                        }
                    }
                }
            }
        }
    }
      
if(!empty($url)){
    $ver="vista/archivos/archivo-".$numero."-".$fecha.".".$extension;
    if(move_uploaded_file($_FILES['archivoIncidencia']['tmp_name'],$archivoIncidencia)){
            echo "true+<br><br><img src='".$url."' style='width:70%;heigth:170px;' class='img-thumbnail'>";
              echo '<br><center><a onclick="VerArchivo(\''.$ver.'\',\''.$compara.'\')" id="cursor">Ver <span class="glyphicon glyphicon-eye-open"></span></a></center>';
        
        include ('../modelo/Datos.php');
        session_start();
        $datosF=new Datos();
        if(!empty($_SESSION['datosF'])){
                $datosF = $_SESSION['datosF'];
            }
        $datosF->archivo=$ver;
        $_SESSION['datosF']=$datosF;
    }else{
        echo "false+<br><br><font color='red'><h4>No se ha podido subir el archivo actualiza e intenta de nuevo</h4></font>";
    }  
}
else{
    echo "false+<br><br><font color='red'><h4>Solo se pueden subir archivos tipo Imagen, Video, Word, Excel, Pdf, Texto</h4></font>";
}

?>