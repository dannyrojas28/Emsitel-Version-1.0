<?php
include "../modelo/Datos.php";

session_start();
$datosF=new Datos();

if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
$cedula=$datosF->cedula;
$query=$datosF->VerificarCedula($cedula);
$sum=1;
if(mysqli_num_rows($query) > 0){
	
	?> <div class="row">
 
 <div class="col-xs-5">
     <br>
                    <div id="titulo-form" class="col-xs-12">
                        <h3>Ubicaciones del Servicio <span class="glyphicon glyphicon-map-marker float"></span></h3>
                    </div>
                <form name="miFormulario" enctype="text/plain">
<?php
        
		while($row=mysqli_fetch_array($query)){
			if($sum == 1){
				echo "<h3>".$row['nombre1_cli']." ".$row['apellido1_cli']."</h3>";
				$datosF->cod_cli=$row['cod_cli'];
                                $datosF->cedula=$cedula;
				$_SESSION['datosF'] = $datosF;
			}
			echo	'<div class="checkbox">
					  <label>
					    <input type="radio" name="mychk" id="chd" value="'.$row['cod_ubi'].'" >
					   '.$row['nombre_ubi'].' - '.$row['direccion_ubi'].' - '.$row['nombre_mun'].'
					  </label>
					</div>';
				$sum=$sum+1;
		}
		$sum=$sum-1;
                ?><input type='hidden' id='valueubi'  value='<?php echo $sum; ?>'></form>
		<span id='span_ubicacion'></span><br>
			<center>
                                    <button type='button' onclick=' VerServiciosPer("vista/include/formActualizarDatosPUbicaciones.php")' class='btn btn-success'> <span class='glyphicon glyphicon-chevron-right'></span>   Mostrar Datos</button>
						</center>
		<hr class='hrcolor'>
				
				<br>
            </div>
<script type="text/javascript">
    document.getElementById('servicios').innerHTML='';
</script>
            <div id="verificarSer" class="col-xs-7">

            </div>

    </div>

<?php
}else{
	echo "No Se Han Encontrado Ubicaciones";

}
?>