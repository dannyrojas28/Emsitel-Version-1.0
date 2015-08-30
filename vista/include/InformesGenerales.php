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
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/informes')">Informes</a></li>
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/InformesGenerales')">Generales</a></li>
  
</ol>  
<h4>Obtener Informes Generales</h4>
            
            <div class="col-xs-12"><br>
                    <label  class="col-xs-2"><span class="glyphicon glyphicon-list"></span> Generar Por:</label>
                    <div class="col-xs-3">
                        <select name="generarpor" onclick="GenerarPorGeneral()"  class="form-control" id="generarpor">
                            <option value="0">...Seleccionar...</option>
                            <option value="1">Clientes Por Nodo</option>
                             <option value="2">Clientes por municipio</option>
                            <option value="3">Estado del Servicio</option>
                            
                       </select>
                        <span id="span_generarPor"></span>
                    </div>
                
                    <div id="mostrar">
                    
                    </div>
                </div>
                <div class="col-xs-12"><br>
                     <center>
                         <input type="hidden" name="numRegistros" id="numero" value="0">
                         <button type="button"  onclick="GenerarInformeGeneral('controlador/GenerarInforme.php')" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span>  Generar Informe</button>
                     </center><hr>
                </div>
<div id="mireporte">
    
</div>