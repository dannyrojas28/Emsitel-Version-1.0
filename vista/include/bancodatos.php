<?php

/*se inicializa la function de session*/
session_start();
/*se crea la variable de session datosF vacia la cual se usara mas adelante*/
$_SESSION['datosF']="";
date_default_timezone_set('America/Bogota');
$fechaInicio=date('Y-m');
$fechaInicio=$fechaInicio."-01";
$fechaFin=date('Y-m-d');
?>
<ol class="breadcrumb">
    <!-- se mostraran las secuencias de los pasos ejecutados -->
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/bancodatos')">Banco De Datos</a></li>
</ol>  
<div id="row">
            <h3>Administracion del banco de Datos</h3><br>
                    <center>
         <!--se muestran los botones de los dos tipos de registros -->
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/usuarios')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-user"></span> Usuarios</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/municipios')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-map-marker"></span> Municipios</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/servicios')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-credit-card"></span> Servicios</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/asesorComer')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-user"></span> Asesores Comerciales</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/estadoCont')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-transfer"></span> Estado de Contratos</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/formatoCont')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-record"></span> Formato Contratos</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/tipoConex')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-equalizer"></span> Tipos de Conexion</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/nodos')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-tag"></span> Nodos</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/antenas')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-tag"></span> Antenas</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/ipBackb')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-lock"></span> Dir Ip Bakcbone</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/ipClien')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-lock"></span> Dir Ip Cliente</button>
         <button type="button" onclick="CargarSubContenido('vista/include/bancodatos/elementos')" id="hoj" class="btn  ct"><span class="glyphicon glyphicon-star-empty"></span> Elementos</button>
         
     </center>
            
</div>