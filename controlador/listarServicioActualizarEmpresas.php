<?php
include "../modelo/Datos.php";
 session_start();
$datosF=new Datos();
if(!empty($_SESSION["datosF"])){
    $datosF = $_SESSION['datosF'];
}

$query=$datosF->VerificarUbicacionesEmp($datosF->cod_ubi);

$sum=1;
echo 		'<div id="servi">
				<div class="col-xs-6">
                <br>
                    <div id="titulo-form" class="col-xs-12">
                         <h3>Tipos de Servicios</h3>
                    </div>
                
                <form name="miFormulario" enctype="text/plain">';
if(mysqli_num_rows($query) > 0){
		echo "<br>
			Esta Ubicacion cuenta con los siguientes Servicios<br>
			
		";
		while($row=mysqli_fetch_array($query)){
			echo '<div class="checkbox">
					  <label>
					    <input type="checkbox" name="mychk" id="chd" value="'.$row['cod_ser_emp'].'">
					   '.$row['nombre_tp'].' - '.$row['nombre_est'].' - '.$row['nombre_forE'].$row['numcontrato_emp'].'
					  </label>
					</div>';
			$sum=$sum+1;
		}
                 $sum=$sum-1;
		?>
		<br><input type='hidden' id='valueser'  value='<?php echo $sum;?>'></form>
		<span id='span_ubicacion'></span><br><button type='button' onclick='MostrarDatosServiciosPer("vista/include/formActualizarDatosEServicios.php")' class='btn btn-success'> <span class='glyphicon glyphicon-chevron-up'></span>   Mostrar Datos</button><br>	
		 <br></div><?php
}else{

	echo "<br><center>
			Esta Ubicacion no tiene ningun servicio<br>
			
		 </center><br></div></div>
		";
}
?>

