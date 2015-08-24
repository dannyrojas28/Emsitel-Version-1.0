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
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/InformeIncidencias')">Incidencias</a></li>
  
</ol>  
<div id="row">
    <div id="col-xs-offset-1 col-xs-11">
        <div class="col-sm-12 col-xs-12">
            <h4>Obtener Estadísticas de Incidencias</h4><br>
            <form name="formulario1" enctype="multipart/form-data">
                 
                <div class="col-xs-12">
                    <label  class="col-xs-2"><span class="glyphicon glyphicon-calendar"></span>  Fecha Inicio</label>
                    <div class="col-xs-3">
                        <input type="date"   class="form-control" name="fechainicio" id="fechainicio" value="<?php echo $fechaInicio; ?>">
                        <span id="span_fechaInicio"></span>
                    </div>
                    <label  class="col-xs-2"><span class="glyphicon glyphicon-calendar"></span>  Fecha Fin</label>
                    <div class="col-xs-3">
                        <input type="date"  class="form-control" name="fechafin" id="fechafin" value="<?php echo $fechaFin; ?>">
                        <span id="span_fechaFin"></span>
                    </div><br>
                </div>
                
                <div class="col-xs-12"><br>
                    <label  class="col-xs-2"><span class="glyphicon glyphicon-list"></span> Generar Por:</label>
                    <div class="col-xs-3">
                        <select name="generarpor" onclick="GenerarPor()"  class="form-control" id="generarpor">
                            <option value="0">...Seleccionar...</option>
                             <option value="1">Total de Incidencias</option>
                             <option value="2">Total por Servicio</option>
                             <option value="3">Total por Creador</option>
                             <option value="4">Total por Tecnico</option>
                       </select>
                        <span id="span_generarPor"></span>
                    </div>
                    <div id="mostrar">
                    
                    </div>
                </div>
                 <div class="col-xs-12"><br>
                     <center>
                         <input type="hidden" name="numRegistros" id="numRegistros" value="0">
                         <button type="button"  onclick="GenerarInforme('controlador/GenerarInforme.php')" class="btn btn-primary"><span class="glyphicon glyphicon-filter"></span>  Generar Informe</button>
                     </center><hr>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="mireporte">
    
</div>