<?php
include "../modelo/Datos.php";
session_start();
$datosF=new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod_ubicacion'])){
    $datosF->cod_ubi=$_POST['cod_ubicacion'];
}
$query=$datosF->VerificarUbicacionesEmp($datosF->cod_ubi);

$_SESSION['datosF']=$datosF;
$sum=1;
echo 		'<div id="servi">
				<div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Tipos de Servicios</h3>
                    </div>
                </div>';
if(mysqli_num_rows($query) > 0){
		echo "<br>
			Esta Ubicacion cuenta con los siguientes Servicios<br>
			
		";
		while($row=mysqli_fetch_array($query)){
			echo '<div class="checkbox">
					  <label>
					    <input type="checkbox" name="mychk" id="chd" value="'.$sum.'" checked disabled >
					   '.$row['nombre_tp'].' - '.$row['nombre_est'].' - '.$row['nombre_forE'].$row['numcontrato_emp'].'
					  </label>
					</div>';
			$sum=$sum+1;
		}

		echo "<br><button type='button' onclick='NuevoServicioPersonal2()' class='btn btn-success'> <span class='glyphicon glyphicon-plus-sign'></span>   Añadir Servicio</button><br>	
		 <br></div>";
}else{
	echo "<br><center>
			Esta Ubicacion no tiene ningun servicio<br>
			<br><button type='button' onclick='NuevoServicioPersonal2()' class='btn btn-success'> <span class='glyphicon glyphicon-plus-sign'></span>   Añadir Servicio</button>	
		 </center><br></div>
		";
}
?>
