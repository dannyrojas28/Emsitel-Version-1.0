<?php
include "../modelo/Datos.php";

session_start();
$datosF=new Datos();
$nit=$_POST['nit_empresa'];
$datosF->nit=$nit;
$_SESSION['datosF'] = $datosF;
$query=$datosF->VerificarNit($nit);
$sum=1;
if(mysqli_num_rows($query) > 0){
	
	echo 'true+<div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Ubicaciones del Servicio</h3>
                    </div>
                </div> <form name="miFormulario" enctype="text/plain">';
        
		while($row=mysqli_fetch_array($query)){
			if($sum == 1){
				echo "<h3>".$row['nombre_emp']."</h3>";
				$datosF->cod_emp=$row['cod_emp'];
				$_SESSION['datosF'] = $datosF;
			}
			echo	'<div class="checkbox">
					  <label>
					    <input type="radio" name="mychk" id="chd" value="'.$row['cod_ubi_emp'].'" >
					   '.$row['nombreubi_emp'].' - '.$row['direccionubi_emp'].' - '.$row['nombre_mun'].'
					  </label>
					</div>';
				$sum=$sum+1;
		}
		$sum=$sum-1;
		?><input type='hidden' id='valueubi'  value='<?php echo $sum; ?>'></form>
		<span id='span_ubicacion'></span><br>
		<button type='button' onclick='NuevaUbicacionPersonal()' class='btn btn-success'> <span class='glyphicon glyphicon-plus-sign'></span>   Nueva Ubicacion</button>	
		<hr class='hrcolor'>
				<center>
					<button type='button' onclick='VerServiciosPer("controlador/verificarubicacionesempresariales.php")' class='btn btn-primary'> <span class='glyphicon glyphicon-chevron-down'></span>   Ver Servicios</button>
						</center>
				<br>
                  <div id='verificarSer'></div> <?php
}else{
	echo "false";

}
?>