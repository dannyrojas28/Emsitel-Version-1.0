<?php
include "../modelo/Datos.php";
$datosF=new Datos();
session_start();
if(!empty($_SESSION['datosF'])){
    $datosF = $_SESSION['datosF'];
}
if(!empty($_POST['cod'])){
    $datosF->cod=$_POST['cod'];
}
if(!empty($_POST['con'])){
   $datosF->con=$_POST['con'];
}
?>
 <ol class="breadcrumb">
    <li><a id="cursor" onclick="CargarSubContenido('vista/include/consultas')">Consultas</a></li>
    <li><a id="cursor" onclick="Incidencias('<?php echo $datosF->cod; ?>')">Incidencias</a></li>
    <div id="regresar">
 <a   onclick="CargarSubContenido('vista/include/consultas')" class="float" id="cursor"> <span class="glyphicon glyphicon-arrow-left"> Regresar</span></a>
</div>
    </ol>
<?php
$query=$datosF->DatosClientesPersonales($datosF->cod);
if($datosF->con == 1) {
     while ($row = mysqli_fetch_array($query)) {
        $datosF->cedula=$row['cedula_cli'];
        $datosF->nombre1=$row['nombre1_cli']." ".$row['nombre2_cli']." ".$row['apellido1_cli']." ".$row['apellido2_cli'];
        $datosF->direccionper=$row['direccion_cli'];
        $datosF->municipioper=$row['municipio_cli'];
        $datosF->telefonoper=$row['telefono_cli'];
        $datosF->celularper=$row['celular_cli'];
        $datosF->emailper=$row['email_cli'];
        
     }
?>   
    <div id="forms">
        <div class="col-xs-12">
         <br>
        <form method="post" enctype="multipart/form-data" name="formulario1">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Personales <span class="glyphicon glyphicon-user float"></span></h3>
                    </div>
                </div>
                
                
                 <div class="form-group">
                     
                    <div class="col-xs-3">
                         <h5 id="examplePass">Cedula</h5> 
                             <input type="number" class="form-control" disabled onkeyup="Cedula('controlador/PresionarCedula.php')" placeholder="Numero de Cedula" name="cedula_persona" id="cedula_persona" value="<?php echo $datosF->cedula; ?>">
                     </div>
                    <div class="col-sm-5 col-xs-12">
                        <h5 id="examplePass">Nombre Completo</h5>
                        <input type="text" class="form-control"  disabled placeholder="Primer Nombre" name="1nombre_persona" id="1nombre_persona" value="<?php echo $datosF->nombre1; ?>">
                        
                    </div>
                     <div class="col-sm-4">
                            <h5 id="examplePass">Email</h5>
                            <input type="email" class="form-control"  disabled placeholder="Correo del cliente" name="email_persona" id="email_persona"  value="<?php echo $datosF->emailper; ?>">
                            
                    </div>
            </div>
                <div class="form-group">
                     <div class="col-sm-3 col-xs-12">
                        <h5 id="examplePass">Telefono</h5>
                        <input type="number" class="form-control" disabled placeholder="Numero telefonico" name="telefono_persona" id="telefono_persona" value="<?php echo $datosF->telefonoper; ?>">
                        
                    </div>
                
                    <div class="col-sm-3">
                        
                        <h5 id="examplePass">Celular</h5>
                        <input type="number" class="form-control" disabled onkeyup="Celular()" placeholder="Numero Celular" name="celular_persona" id="celular_persona" value="<?php echo $datosF->celularper; ?>">
                        
                    </div>
          
                  
                    <div class="col-sm-3 col-xs-12">
                        <h5 id="examplePass">Direccion</h5>
                        <input type="text" class="form-control" disabled  placeholder="Direccion de vivienda" name="direccion_persona" id="direccion_persona" value="<?php echo $datosF->direccionper; ?>">
                       
                    </div>
                   
                    <div class="col-sm-3 col-xs-12">
                         <h5 id="examplePass">Municipio</h5>
                        <select class="form-control" name="municipio_persona"  disabled id="municipio_persona">
                            <option value="0">Seleccione el Municipio</option>
                             <?php
                                $query2=$datosF->BD_Municipios();
                                while($row=mysqli_fetch_array($query2)){
                                    if($datosF->municipioper == $row['cod_mun']){
                                        echo '<option value="'.$row['cod_mun'].'" selected>'.$row['nombre_mun'].'</option>';
                                    }else{
                                        echo '<option value="'.$row['cod_mun'].'">'.$row['nombre_mun'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        </div>
                   
                   
                   </div>
            </form>
          
        </div>


    </div>
<?php    
    $cedula=$datosF->cedula;
        $query=$datosF->VerificarCedula($cedula);
        $sum=1;
        if(mysqli_num_rows($query) > 0){

            ?>

         <div class="col-xs-12" id="ubis">
             <br>
                            <div id="titulo-form" class="col-xs-12">
                                <h3>Ubicaciones del Servicio <span class="glyphicon glyphicon-map-marker float"></span></h3>
                            </div>
             <div class="col-xs-offset-1 col-xs-10">
                 <form name="miFormulario" enctype="text/plain"><br>
                     <ul class="list-group">
        <?php

                while($row=mysqli_fetch_array($query)){
                  ?>
                         <li class="list-group-item list-group-item-success">
                             <div id="icon<?php echo $sum; ?>">
                                  <a  onclick="ServiciosIncidencias('<?php echo $row['cod_ubi']; ?>','servicio<?php echo $sum; ?>','icon<?php echo $sum; ?>')" class="float" id="cursor"> <span class="glyphicon glyphicon-chevron-down"></span></a>
                             </div> 
                             <?php echo $sum.'- '.$row['nombre_ubi'].' - '.$row['direccion_ubi'].' - '.$row['nombre_mun'] ;?>
                         </li>
                         <?php
                     echo ' <div id="servicio'.$sum.'">';
                       
                   echo '</div>';
                $sum+=1;
               
                } ?> </ul>
                 </form>
                 <br>
                 
             </div>
           </div>
<?php
        }else{
            echo "No Se Han Encontrado Ubicaciones";

        }
        
 }
else{
    $query=$datosF->DatosClientesEmpresariales($datosF->cod);
    while ($row = mysqli_fetch_array($query)) {
        $datosF->nit=$row['nitcedula_emp'];
        $datosF->nombre_emp=$row['nombre_emp'];
        $datosF->nombrerep_emp=$row['representantelegal_emp'];
        $datosF->direccion_emp=$row['direccion_emp'];
        $datosF->municipio_emp=$row['municipio_emp'];
        $datosF->telefonoper=$row['telefono_emp'];
        $datosF->celularper=$row['celular_emp'];
        $datosF->emailper=$row['email_emp'];

    }
    ?>
 <div id="forms" >
        <div class="col-xs-12">
            <br>
        <form method="post" enctype="multipart/form-data" name="formulario1">
                <div class="row">
                    <div id="titulo-form" class="col-xs-12">
                    <h3>Datos Empresariales <span class="glyphicon glyphicon-equalizer float"></span></h3>
                    </div>
                </div>
                
                
                
                 <div class="form-group">
                     <br>
                    <div class="col-xs-3">
                        <h5 id="examplePass">Nit/Cedula</h5>
                                <input type="text" class="form-control" disabled name="nit_empresa" id="cedula_persona" value="<?php echo $datosF->nit; ?>">
                     </div>
                    <div class=" col-xs-3">
                        <h5 id="examplePass"> Nombre Empresa</h5>
                        <input type="text" class="form-control"  disabled  name="nombre_empresa" id="1nombre_persona" value="<?php echo $datosF->nombre_emp; ?>">
                     
                    </div>
                    
                    <div class=" col-xs-3">
                        <h5 id="examplePass"> Representante Legal</h5>
                        <input type="text" class="form-control"  disabled   name="nombre_representane" id="1apellido_persona" value="<?php echo $datosF->nombrerep_emp; ?>">
                    </div>
                    
                    <div class="col-xs-3">
                        <h5 id="examplePass">Email</h5>
                        <input type="email" class="form-control" disabled  name="email_persona" id="email_persona"  value="<?php echo $datosF->emailper; ?>">
                   </div>
                </div>
               <div class="form-group">
                    <div class="col-sm-3 col-xs-12">
                        <h5 id="examplePass">Telefono</h5>
                        <input type="number" class="form-control" disabled  name="telefono_persona" id="telefono_persona" value="<?php echo $datosF->telefonoper; ?>">
                        
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        
                        <h5 id="examplePass">Celular</h5>
                        <input type="number" class="form-control" disabled name="celular_persona" id="celular_persona" value="<?php echo $datosF->celularper; ?>">
                       
                    </div>
                    <div class="col-sm-3 col-xs-12">
                        <h5 id="examplePass">Direccion</h5>
                        <input type="text" class="form-control" disabled name="direccion_empresa" id="direccion_empresa" value="<?php echo $datosF->direccion_emp; ?>">
                    </div>  
                    <div class="col-sm-3 col-xs-12">
                         <h5 id="examplePass">Municipio</h5>
                        <select class="form-control" disabled  name="municipio_empresa" id="municipio_persona">
                            <option value="0">Seleccione el Municipio</option>
                             <?php
                                $query2=$datosF->BD_Municipios();
                                while($row=mysqli_fetch_array($query2)){
                                    if( $datosF->municipio_emp == $row['cod_mun']){
                                         echo '<option value="'.$row['cod_mun'].'" selected>'.$row['nombre_mun'].'</option>';
                                
                                    }else{
                                       echo '<option value="'.$row['cod_mun'].'">'.$row['nombre_mun'].'</option>';
                                 
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
                
        </div>
    </div>

  
<?php
        
        $query=$datosF->VerificarNit($datosF->nit);
        $sum=1;
        if(mysqli_num_rows($query) > 0){
   ?>
                    <div class="col-xs-12" id="ubis">
                                 <br>
                                   <div id="titulo-form" class="col-xs-12">
                                            <h3>Ubicaciones del Servicio <span class="glyphicon glyphicon-map-marker float"></span></h3>
                                   </div>
                                 <div class="col-xs-offset-1 col-xs-10">
                                     <form name="miFormulario" enctype="text/plain"><br>
                                         <ul class="list-group">
                            <?php

                                    while($row=mysqli_fetch_array($query)){
                                      ?>
                                             <li class="list-group-item list-group-item-success">
                                                 <div id="icon<?php echo $sum; ?>">
                                                      <a  onclick="ServiciosIncidencias('<?php echo $row['cod_ubi_emp']; ?>','servicio<?php echo $sum; ?>','icon<?php echo $sum; ?>')" class="float" id="cursor"> <span class="glyphicon glyphicon-chevron-down"></span></a>
                                                 </div> 
                                                 <?php echo $sum.'- '.$row['nombreubi_emp'].' - '.$row['direccionubi_emp'].' - '.$row['nombre_mun'] ;?>
                                             </li>
                                             <?php
                                         echo ' <div id="servicio'.$sum.'">';

                                       echo '</div>';
                                    $sum+=1;

                                    } ?> </ul>
                                     </form>
                                     <br>

                                 </div>
                               </div>
      <?php
            }
    
}
$_SESSION['datosF']=$datosF;
?>