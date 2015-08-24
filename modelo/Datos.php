<?php
include "conexion.php";
 class Datos extends Conexion{
    /**
     *
     * @var creo las variables para los datos personales
     */
     public $ima=0;
    public $cod="";
         public $con="";
    public $cod_cli="";
    public $cedula = "";
    public $nombre1 = "";
    public $nombre2 = "";
    public $apellido1 = "";
    public $apellido2 = "";
    public $direccionper = "";
    public $municipioper =0;
    public $telefonoper = "";
    public $celularper = "";
    public $emailper = "";
    public $cod_ubi="";
    public $nombreubi = ""; 
    public $direccionubi = "";
    public $municipioubi = 0;
    public $nombre_per_ubi = "";
    public $apellido_per_ubi = "";
    public $telefono_per_ubi = "";
    public $celular_per_ubi = "";
    public $email_per_ubi = "";
    public $tiposervicio=0;
    public $estadoservicio=0;
    public $formato_contrato=0;
    public $num_contrato="";
    public $fechaini="";
    public $fechafin="";
    public $asesorcomercial=0;
    public $descripcion_contrato="";
    public $tipoconexion=0;
    public $descripcionip1="";
    public $descripcionip2="";
    public $descripcionipc2="";
    public $velocidadmax="";
    public $velocidadmin="";
    public $nodo="";
    public $antena="";
    public $equipos=0;
    public $mac_serial="";
    public $descripcionmac="";
    public $cod_ser="";
    public $cod_det="";
    public $codipC="";
    public $codipE="";
    public $codipB="";
    
     /**
     *
     * @var creo las variables para los datos empresariales 
     */
   public $nit="";
   public $cod_emp="";
   public $nombre_emp="";
   public $direccion_emp="";
   public $municipio_emp=0;
   public $nombrerep_emp=""; 
    private $_conexion;
    
     function __construct(){
        $this->_conexion=new Conexion();
    }
    
    /**
     * 
     * Se realizaran todas las consultas para los formularios seleccionables
     */
    public function SelectCodDatPer(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_cli FROM datos_clientes_personales ORDER by cod_cli DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectCodUbiPer(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_ubi FROM ubicacion_servicio_personal ORDER by cod_ubi DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectCodSerPer(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_ser FROM tiposervicio_personal ORDER by cod_ser DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectCodDetPer(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_det FROM detalleservicio_personal ORDER by cod_det DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    
    public function BD_TiposServicio(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_tiposervicio";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    
    public function BD_EstadoServicio(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_estadoservicio";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     public function BD_IpBakbone(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_IPBakbone";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     public function BD_IpCliente(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_IPCliente";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
      public function BD_Elementos(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_elementosEquipos";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     
    public function BD_FormatosContrato(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_formatoscontrato";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function BD_AsesorComercial(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_asesorescomerciales";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function BD_TipoConexion(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_tipoconexion";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function BD_Antena(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_antenas";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function BD_Nodo(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_nodo";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function BD_Municipios(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM BD_municipios";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function NumeroContrato($formato,$numero){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT nombre_for,numcontrato_ser FROM tiposervicio_personal,BD_formatoscontrato WHERE BD_formatoscontrato.cod_for=tiposervicio_personal.formatocontrato_ser AND BD_formatoscontrato.cod_for='$formato' AND numcontrato_ser='$numero'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    } 
      public function NumeroContratoEmpresarial($formato,$numero){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT nombre_forE,numcontrato_emp FROM tiposervicio_empresarial,BD_formatoscontratoEmprs WHERE BD_formatoscontratoEmprs.cod_forE=tiposervicio_empresarial.formatocontrato_emp AND BD_formatoscontratoEmprs.cod_forE='$formato' AND numcontrato_emp='$numero'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    } 
    public function TipoServicio($tipo,$cod_ubi){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT tiposervicio FROM tiposervicio_personal WHERE cod_ubicacion='$cod_ubi' AND tiposervicio='$tipo'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
        
    }
    
    /**
     * 
     * @returnSe realizaran todas las operaciones y sql para el modulo de clientes Personales
     */
    public function RegistrarDatosPersonales($cod_per,$cedula,$nombre1,$nombre2,$apellido1,$apellido2,$direccionper,$municipioper,$telefonoper,$celularper,$emailper){
        
    $conexion=$this->EstablecerConexion();
      if(empty($telefonoper)){
          $telefonoper=0;
      }
      if(empty($celularper)){
          $celularper=0;
      }
    $sql="INSERT INTO datos_clientes_personales(cod_cli,cedula_cli,nombre1_cli,nombre2_cli,apellido1_cli,apellido2_cli,direccion_cli,municipio_cli,telefono_cli,celular_cli,email_cli)"
            . " VALUES ('$cod_per','$cedula','$nombre1','$nombre2','$apellido1','$apellido2','$direccionper','$municipioper','$telefonoper','$celularper','$emailper')";
    $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
        
    }
    public function RegistrarUbicacionServicio($cod_ubi,$nombreubi,$direccionubi,$municipioubi,$nombrepersitio,$apellidopersitio,$telefonopersitio,$celularpersitio,$emailpersitio,$codper){
        
    $conexion=$this->EstablecerConexion();
        if(empty($telefonopersitio)){
          $telefonopersitio=0;
      }
      if(empty($celularpersitio)){
          $celularpersitio=0;
      }
    $sql="INSERT INTO ubicacion_servicio_personal(cod_ubi,nombre_ubi,direccion_ubi,municipio_ubi,nombre_per_sitio_ubi,apellido_per_sitio_ubi,telefono_per_sitio_ubi, "
        ."celular_per_sitio_ubi,email_per_sitio_ubi,cod_persona) VALUES ('$cod_ubi','$nombreubi','$direccionubi','$municipioubi','$nombrepersitio','$apellidopersitio','$telefonopersitio','$celularpersitio','$emailpersitio','$codper')";
    $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
        
    }
    public function RegistrarTipoServicio($cod_ser,$tiposervicio,$estadoservicio,$formatocontrato,$numcontrato,$fechaini,$fechafin,$asesorcomercial,$descripcioncomercial,$cod_ubi){
        
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO tiposervicio_personal(cod_ser,tiposervicio,estadoservicio,formatocontrato_ser,numcontrato_ser,fechainicio_ser,fechafin_ser,asesorcomercial_ser,descripcomercial_ser,cod_ubicacion) "
            ."VALUES ('$cod_ser','$tiposervicio','$estadoservicio','$formatocontrato','$numcontrato','$fechaini','$fechafin','$asesorcomercial','$descripcioncomercial','$cod_ubi')";
    $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
        
    }
    public function RegistrarDetalleServicio($cod_det,$tipoconex,$velmax_det,$velmin_det,$nodo_det,$antena_det,$cod_tiposervicio){
        
    $conexion=$this->EstablecerConexion();
     if(empty($velmax_det)){
          $velmax_det=0;
      }
      if(empty($velmin_det)){
          $velmin_det=0;
      }
    $sql="INSERT INTO detalleservicio_personal(cod_det,tipoconex,velmax_det,velmin_det,nodo_det,antena_det,cod_tiposervicio)"
    ."VALUES  ('$cod_det','$tipoconex','$velmax_det','$velmin_det','$nodo_det','$antena_det','$cod_tiposervicio')";
    $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
        
    }
    public function RegistrarIpBackbonePer($direccionip,$descripcionip,$cod_det){
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO direcciones_ip_backbone(direccionip_bak,descripcionip_bak,cod_det) VALUES ('$direccionip','$descripcionip','$cod_det')";
     $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
    }
    public function RegistrarIpClientePer($direccionip,$descripcionip,$cod_det){
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO direcciones_ip_clientes(direccionip_cli,descripcionip_cli,cod_det) VALUES ('$direccionip','$descripcionip','$cod_det')";
     $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
    }
    public function RegistrarIpEquipoPer($direccionip,$mac,$descripcionip,$cod_det){
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO equipos_personales(elemento,mac_ip,descripcion,cod_det) VALUES ('$direccionip','$mac','$descripcionip','$cod_det')";
     $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
    }
    public function Consulta25ClientesPersonales(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_cli,cedula_cli,nombre1_cli,apellido1_cli,email_cli,nombre_mun FROM "
                . "datos_clientes_personales,BD_municipios WHERE  datos_clientes_personales.municipio_cli=BD_municipios.cod_mun group by cedula_cli  ORDER BY nombre1_cli ASC limit 0,25 ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function VerificarUbicacionesPer($cod_ubi){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT nombre_est,nombre_tp,nombre_for,numcontrato_ser,cod_ser FROM tiposervicio_personal,BD_estadoservicio,BD_tiposervicio,BD_formatoscontrato WHERE BD_estadoservicio.cod_est=tiposervicio_personal.estadoservicio AND BD_tiposervicio.cod_tp=tiposervicio_personal.tiposervicio AND BD_formatoscontrato.cod_for=tiposervicio_personal.formatocontrato_ser AND cod_ubicacion='$cod_ubi'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function VerificarCedula($cedula){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_ubi,nombre_ubi,direccion_ubi,cod_cli,cedula_cli,nombre_mun,nombre1_cli,apellido1_cli FROM datos_clientes_personales,ubicacion_servicio_personal,BD_municipios WHERE datos_clientes_personales.cod_cli=ubicacion_servicio_personal.cod_persona AND BD_municipios.cod_mun=ubicacion_servicio_personal.municipio_ubi AND datos_clientes_personales.cedula_cli='$cedula' GROUP BY cod_ubi";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    
    public function FiltroClientesPersonales($palabra){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_cli,cedula_cli,nombre1_cli,apellido1_cli,email_cli,nombre_mun FROM "
                . "datos_clientes_personales,BD_municipios WHERE  datos_clientes_personales.municipio_cli=BD_municipios.cod_mun AND (cedula_cli LIKE '%".$palabra."%' OR `nombre1_cli` LIKE '%".$palabra."%' OR `apellido1_cli` LIKE '%".$palabra."%' OR `email_cli` "
                . "LIKE '%".$palabra."%' ) group by cedula_cli ORDER BY nombre1_cli ASC limit "
                . "0,25 ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    
    }
    public function FiltroClientesPersonalesNombre($nombre,$apellido){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_cli,cedula_cli,nombre1_cli,apellido1_cli,email_cli,nombre_mun "
                . "FROM datos_clientes_personales,ubicacion_servicio_personal,tiposervicio_personal,BD_municipios WHERE  datos_clientes_personales.municipio_cli=BD_municipios.cod_mun AND (nombre1_cli LIKE '%".$nombre."%' AND `apellido1_cli` LIKE '%".$apellido."%' ) group by cedula_cli ORDER BY nombre1_cli ASC limit 0,25";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     public function FiltroClientesPersonalesContrato($nombre_contrato,$num_contrato){
        $conexion=$this->EstablecerConexion();
    $email=$nombre_contrato.$num_contrato;
        $sql="SELECT cod_cli,cedula_cli,nombre1_cli,apellido1_cli,email_cli,nombre_for,numcontrato_ser "
                . "FROM datos_clientes_personales,ubicacion_servicio_personal,tiposervicio_personal,BD_formatoscontrato"
                . " WHERE datos_clientes_personales.cod_cli=ubicacion_servicio_personal.cod_persona "
                . "AND ubicacion_servicio_personal.cod_ubi=tiposervicio_personal.cod_ubicacion AND "
                . "BD_formatoscontrato.cod_for=tiposervicio_personal.formatocontrato_ser AND"
                . "(cedula_cli  LIKE '%".$email."%' OR email_cli LIKE '%".$email."%' OR nombre_for LIKE '%".$nombre_contrato."%' AND numcontrato_ser LIKE '%".$num_contrato."%' ) "
                . "group by cedula_cli ORDER BY nombre1_cli ASC limit 0,25"; $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    
    public function DatosClientesPersonales($cod_cli){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM datos_clientes_personales WHERE cod_cli='$cod_cli'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function UbicacionesClientesPersonales($cod_ubi){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM ubicacion_servicio_personal WHERE cod_ubi='$cod_ubi'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     public function SelectIpBackbone($cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT direcciones_ip_backbone.* FROM direcciones_ip_backbone,detalleservicio_personal WHERE  detalleservicio_personal.cod_det=direcciones_ip_backbone.cod_det AND cod_tiposervicio='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectIpCliente($cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT direcciones_ip_clientes.* FROM detalleservicio_personal,direcciones_ip_clientes WHERE detalleservicio_personal.cod_det=direcciones_ip_clientes.cod_det AND cod_tiposervicio='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectIpEquipos($cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT equipos_personales.* FROM detalleservicio_personal,equipos_personales WHERE detalleservicio_personal.cod_det=equipos_personales.cod_det AND cod_tiposervicio='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     public function ServiciosClientesPersonales($cod_ser){
        $conexion=$this->EstablecerConexion();
            $sql="SELECT tiposervicio_personal.*,detalleservicio_personal.* "
                . "FROM  tiposervicio_personal,detalleservicio_personal where "
               . " tiposervicio_personal.cod_ser=detalleservicio_personal.cod_tiposervicio "
                . " AND cod_ser='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    function ActualizarDatosCliPer($cedula,$nombre1,$nombre2,$apellido1,$apellido2,$direccionper,$municipioper,$telefonoper,$celularper,$emailper,$cod_per){
        $conexion=$this->EstablecerConexion();
        if(empty($telefonoper)){
          $telefonoper=0;
      }
      if(empty($celularper)){
          $celularper=0;
      }
        $sql="UPDATE datos_clientes_personales SET cedula_cli='$cedula',nombre1_cli='$nombre1',nombre2_cli='$nombre2',"
                . "apellido1_cli='$apellido1',apellido2_cli='$apellido2',direccion_cli='$direccionper',municipio_cli='$municipioper',"
                . "telefono_cli='$telefonoper',celular_cli='$celularper',email_cli='$emailper' WHERE cod_cli='$cod_per'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarUbicacionesCliPer($nombreubi,$direccionubi,$municipioubi,$nombrepersitio,$apellidopersitio,$telefonopersitio,$celularpersitio,$emailpersitio,$codubi){
        $conexion=$this->EstablecerConexion();
        if(empty($telefonopersitio)){
          $telefonopersitio=0;
      }
      if(empty($celularpersitio)){
          $celularpersitio=0;
      }
        $sql="UPDATE ubicacion_servicio_personal SET nombre_ubi='$nombreubi',direccion_ubi='$direccionubi',municipio_ubi='$municipioubi',"
                . "nombre_per_sitio_ubi='$nombrepersitio',apellido_per_sitio_ubi='$apellidopersitio',telefono_per_sitio_ubi='$telefonopersitio',"
                . "celular_per_sitio_ubi='$celularpersitio',email_per_sitio_ubi='$emailpersitio' WHERE cod_ubi='$codubi'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarServiciosPersonales($tiposervicio,$estadoservicio,$formatocontrato,$numcontrato,$fechainicio,$fechafin,$asesorcomercial,$descripcioncomercial,$cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE tiposervicio_personal SET tiposervicio='$tiposervicio',estadoservicio='$estadoservicio',"
                . "formatocontrato_ser='$formatocontrato',numcontrato_ser='$numcontrato',"
                . "fechainicio_ser='$fechainicio',fechafin_ser='$fechafin',asesorcomercial_ser='$asesorcomercial',"
                . "descripcomercial_ser='$descripcioncomercial' WHERE cod_ser='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
     function ActualizarDetallesPersonales($tipoconex,$velocidadmax,$velocidadmin,$nodo_det,$antena_det,$cod_det){
        $conexion=$this->EstablecerConexion();
         if(empty($velocidadmax)){
          $velocidadmax=0;
      }
      if(empty($velocidadmin)){
          $velocidadmin=0;
      }
        $sql="UPDATE detalleservicio_personal SET tipoconex='$tipoconex',velmax_det='$velocidadmax',"
                . "velmin_det='$velocidadmin',nodo_det='$nodo_det',antena_det='$antena_det'"
                . "WHERE cod_det='$cod_det'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarIpBackPersonales($direccion_bak,$descripcion_bak,$cod_bak){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE direcciones_ip_backbone SET direccionip_bak='$direccion_bak',descripcionip_bak='$descripcion_bak' WHERE cod_bak='$cod_bak'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarIpClientesPersonales($direccion_cli,$descripcion_cli,$cod_cli){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE direcciones_ip_clientes SET direccionip_cli='$direccion_cli',descripcionip_cli='$descripcion_cli' WHERE cod_cli='$cod_cli'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarIpEquiposPersonales($direccion_ip,$mac_ip,$descripcion_ip,$cod_dir){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE equipos_personales SET elemento='$direccion_ip',mac_ip='$mac_ip',descripcion='$descripcion_ip' WHERE cod_dir='$cod_dir'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    
    /**
     * Codigo relacionado para la parte de clientes Empresariales
     * 
     */
    
    public function VerificarNit($nit){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_ubi_emp,nombreubi_emp,direccionubi_emp,cod_emp,nitcedula_emp,nombre_mun,nombre_emp FROM datos_clientes_empresariales,ubicacion_servicio_empresarial,BD_municipios WHERE datos_clientes_empresariales.cod_emp=ubicacion_servicio_empresarial.cod_empresa AND BD_municipios.cod_mun=ubicacion_servicio_empresarial.municipioubi_emp AND datos_clientes_empresariales.nitcedula_emp='$nit'";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     public function SelectCodDatEmp(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_emp FROM datos_clientes_empresariales ORDER by cod_emp DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectCodUbiEmp(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_ubi_emp FROM ubicacion_servicio_empresarial ORDER by cod_ubi_emp DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectCodSerEmp(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_ser_emp FROM tiposervicio_empresarial ORDER by cod_ser_emp DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectCodDetEmp(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_det_emp FROM detalleservicio_empresarial ORDER by cod_det_emp DESC LIMIT 0,1";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    
     public function RegistrarDatosEmpresariales($cod_emp,$nit,$nombre_emp,$representante,$direccionemp,$municipioemp,$telefonoemp,$celularemp,$emailemp){
         $conexion=$this->EstablecerConexion();
         if(empty($telefonoemp)){
          $telefonoemp=0;
      }
      if(empty($celularemp)){
          $celularemp=0;
      }
        $sql="INSERT INTO datos_clientes_empresariales(cod_emp,nitcedula_emp,nombre_emp, "
                . "representantelegal_emp,direccion_emp,municipio_emp,telefono_emp,"
                . "celular_emp,email_emp) VALUES ('$cod_emp','$nit','$nombre_emp','$representante',"
                . "'$direccionemp','$municipioemp','$telefonoemp','$celularemp','$emailemp')";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
     public function RegistrarUbicacionesEmpresariales($cod_ubi,$nombreubi,$direccionubi,$municipioubi,$nombreperubi,$apellidoperubi,$telefonoperubi,$celularperubi,$emailperubi,$cod_emp){
        $conexion=$this->EstablecerConexion();
         if(empty($telefonoperubi)){
          $telefonoperubi=0;
      }
      if(empty($celularperubi)){
          $celularperubi=0;
      }
        $sql="INSERT INTO `ubicacion_servicio_empresarial`(`cod_ubi_emp`, `nombreubi_emp`, `direccionubi_emp`, "
                . "`municipioubi_emp`, `nombre_per_sitio_ubi`, `apellido_per_sitio_ubi`, `telefono_per_sitio_ubi`,"
                . " `celular_per_sitio_ubi`, `email_per_sitio_ubi`, `cod_empresa`) VALUES ('$cod_ubi','$nombreubi',"
                . "'$direccionubi','$municipioubi','$nombreperubi','$apellidoperubi','$telefonoperubi','$celularperubi','$emailperubi','$cod_emp')";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function RegistrarTipoServicioEmpresarial($cod_ser,$tiposervicio,$estadoservicio,$formatocontrato,$numcontrato,$fechaini,$fechafin,$asesorcomercial,$descripcioncomercial,$cod_ubi){
        
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO `tiposervicio_empresarial`(`cod_ser_emp`, `tipo_servicio_emp`, `estado_servicio_emp`, `formatocontrato_emp`, `numcontrato_emp`, `fechainicio_emp`, `fechafin_emp`, `asesorcomercial_emp`, `descripcioncomercial_emp`, `cod_ubicacion_emp`) "
            ."VALUES ('$cod_ser','$tiposervicio','$estadoservicio','$formatocontrato','$numcontrato','$fechaini','$fechafin','$asesorcomercial','$descripcioncomercial','$cod_ubi')";
    $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
        
    }
    public function RegistrarDetalleServicioEmpresarial($cod_det,$tipoconex,$velmax_det,$velmin_det,$nodo_det,$antena_det,$cod_tiposervicio){
        if(empty($velmax_det)){
          $velmax_det=0;
      }
      if(empty($velmin_det)){
          $velmin_det=0;
      }
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO `detalleservicio_empresarial`(`cod_det_emp`, `tipocone_emp`, `velmax_emp`, `velmin_emp`, `nodo_emp`, `antena_emp`, `cod_servicio_emp`)"
    ."VALUES  ('$cod_det','$tipoconex','$velmax_det','$velmin_det','$nodo_det','$antena_det','$cod_tiposervicio')";
    $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
        
    }
    public function RegistrarIpBackboneEmp($direccionip,$descripcionip,$cod_det){
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO `direcciones_ip_bakcbone_emp`( `direccionip_bak_emp`, `descripcion_bak_emp`, `cod_det_emp`) VALUES ('$direccionip','$descripcionip','$cod_det')";
     $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
    }
    public function RegistrarIpClienteEmp($direccionip,$descripcionip,$cod_det){
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO `direcciones_ip_clientes_emp`(`direccionip_cli_emp`, `descripcionip_cli_emp`, `cod_det_emp`)  VALUES ('$direccionip','$descripcionip','$cod_det')";
     $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
    }
    public function RegistrarIpEquipoEmp($direccionip,$mac,$descripcionip,$cod_det){
    $conexion=$this->EstablecerConexion();
    $sql="INSERT INTO equipos_empresas(`elemento_emp`, `mac_emp`, `descripcion_emp`, `cod_det`) VALUES ('$direccionip','$mac','$descripcionip','$cod_det')";
     $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
    return $query;
    }
     public function VerificarUbicacionesEmp($cod_ubi){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT nombre_est,nombre_tp,nombre_forE,numcontrato_emp,cod_ser_emp FROM tiposervicio_empresarial,BD_estadoservicio,BD_tiposervicio,BD_formatoscontratoEmprs WHERE BD_estadoservicio.cod_est=tiposervicio_empresarial.estado_servicio_emp AND BD_tiposervicio.cod_tp=tiposervicio_empresarial.tipo_servicio_emp AND BD_formatoscontratoEmprs.cod_forE=tiposervicio_empresarial.formatocontrato_emp AND cod_ubicacion_emp='$cod_ubi'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function TipoServicioEmp($tipo,$cod_ubi){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT tipo_servicio_emp FROM tiposervicio_empresarial WHERE cod_ubicacion_emp='$cod_ubi' AND tipo_servicio_emp='$tipo'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
        
    }
      public function Consulta25ClientesEmpresariales(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_emp,nitcedula_emp,nombre_emp,email_emp,nombre_mun FROM "
                . "datos_clientes_empresariales,BD_municipios WHERE  datos_clientes_empresariales.municipio_emp=BD_municipios.cod_mun group by nitcedula_emp ORDER BY nombre_emp ASC limit 0,25 ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }

    public function FiltroClientesEmpresariales($palabra){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT cod_emp,nitcedula_emp,nombre_emp,email_emp,nombre_mun FROM "
                . "datos_clientes_empresariales,BD_municipios WHERE  datos_clientes_empresariales.municipio_emp=BD_municipios.cod_mun AND (nitcedula_emp LIKE '%".$palabra."%' OR `nombre_emp` LIKE '%".$palabra."%' OR `email_emp` LIKE '%".$palabra."%') group by nitcedula_emp ORDER BY nombre_emp ASC limit 0,25 ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    
    }
   
     public function FiltroClientesEmpresarialesContrato($nombre_contrato,$num_contrato){
        $conexion=$this->EstablecerConexion();
        $palabra=$nombre_contrato.$num_contrato;
        $sql="SELECT cod_emp,nitcedula_emp,nombre_emp,email_emp,nombre_forE,numcontrato_emp "
                . "FROM datos_clientes_empresariales,tiposervicio_empresarial,BD_formatoscontratoEmprs,ubicacion_servicio_empresarial"
                . " WHERE datos_clientes_empresariales.cod_emp=ubicacion_servicio_empresarial.cod_empresa "
                . "AND ubicacion_servicio_empresarial.cod_ubi_emp=tiposervicio_empresarial.cod_ubicacion_emp AND "
                . "BD_formatoscontratoEmprs.cod_forE=tiposervicio_empresarial.formatocontrato_emp AND ( nitcedula_emp LIKE '%".$palabra."%' OR nombre_emp LIKE '%".$palabra."%' OR  email_emp LIKE '%".$palabra."%' OR nombre_forE LIKE '%".$nombre_contrato."%' AND numcontrato_emp LIKE '%".$num_contrato."%' ) "
                . "group by nitcedula_emp ORDER BY nombre_emp ASC limit 0,25"; $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    
    public function DatosClientesEmpresariales($cod){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM datos_clientes_empresariales WHERE cod_emp='$cod' ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    
    }
     public function FormatoContratoEmpresas(){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT *  FROM BD_formatoscontratoEmprs  ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    
    }
     public function UbicacionesClientesEmpresariales($cod){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT * FROM ubicacion_servicio_empresarial WHERE cod_ubi_emp='$cod' ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    
    }
    public function ServiciosClientesEmpresariales($cod_ser){
        $conexion=$this->EstablecerConexion();
            $sql="SELECT tiposervicio_empresarial.*,detalleservicio_empresarial.* "
                . "FROM  tiposervicio_empresarial,detalleservicio_empresarial where "
               . " tiposervicio_empresarial.cod_ser_emp=detalleservicio_empresarial.cod_servicio_emp "
                . " AND cod_ser_emp='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
      public function SelectIpBackboneEmp($cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT direcciones_ip_bakcbone_emp.* FROM direcciones_ip_bakcbone_emp,detalleservicio_empresarial WHERE  detalleservicio_empresarial.cod_det_emp=direcciones_ip_bakcbone_emp.cod_det_emp AND cod_servicio_emp='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectIpClienteEmp($cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT direcciones_ip_clientes_emp.* FROM detalleservicio_empresarial,direcciones_ip_clientes_emp WHERE detalleservicio_empresarial.cod_det_emp=direcciones_ip_clientes_emp.cod_det_emp AND cod_servicio_emp='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function SelectIpEquiposEmp($cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="SELECT equipos_empresas.* FROM detalleservicio_empresarial,equipos_empresas WHERE detalleservicio_empresarial.cod_det_emp=equipos_empresas.cod_det AND cod_servicio_emp='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    public function ActualizarDatosEmpresariales($nit,$nombre_emp,$representante,$direccionemp,$municipioemp,$telefonoemp,$celularemp,$emailemp,$cod_emp){
        $conexion=$this->EstablecerConexion();
        if(empty($telefonoemp)){
          $telefonoemp=0;
      }
      if(empty($celularemp)){
          $celularemp=0;
      }
        $sql="UPDATE `datos_clientes_empresariales` SET `nitcedula_emp`='$nit',`nombre_emp`='$nombre_emp',`representantelegal_emp`='$representante',`direccion_emp`='$direccionemp',`municipio_emp`='$municipioemp',`telefono_emp`='$telefonoemp',`celular_emp`='$celularemp',`email_emp`='$emailemp' WHERE cod_emp='$cod_emp'";
        $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
    }
    function ActualizarUbicacionesCliEmp($nombreubi,$direccionubi,$municipioubi,$nombrepersitio,$apellidopersitio,$telefonopersitio,$celularpersitio,$emailpersitio,$codubi){
        $conexion=$this->EstablecerConexion();
        if(empty($telefonopersitio)){
          $telefonopersitio=0;
      }
      if(empty($celularpersitio)){
          $celularpersitio=0;
      }
        $sql="UPDATE ubicacion_servicio_empresarial SET nombreubi_emp='$nombreubi',direccionubi_emp='$direccionubi',municipioubi_emp='$municipioubi',"
                . "nombre_per_sitio_ubi='$nombrepersitio',apellido_per_sitio_ubi='$apellidopersitio',telefono_per_sitio_ubi='$telefonopersitio',"
                . "celular_per_sitio_ubi='$celularpersitio',email_per_sitio_ubi='$emailpersitio' WHERE cod_ubi_emp='$codubi'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarServiciosEmpresariales($tiposervicio,$estadoservicio,$formatocontrato,$numcontrato,$fechainicio,$fechafin,$asesorcomercial,$descripcioncomercial,$cod_ser){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE tiposervicio_empresarial SET tipo_servicio_emp='$tiposervicio',estado_servicio_emp='$estadoservicio',"
                . "formatocontrato_emp='$formatocontrato',numcontrato_emp='$numcontrato',"
                . "fechainicio_emp='$fechainicio',fechafin_emp='$fechafin',asesorcomercial_emp='$asesorcomercial',"
                . "descripcioncomercial_emp='$descripcioncomercial' WHERE cod_ser_emp='$cod_ser'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
     function ActualizarDetallesEmpresariales($tipoconex,$velocidadmax,$velocidadmin,$nodo_det,$antena_det,$cod_det){
        $conexion=$this->EstablecerConexion();
         if(empty($velocidadmax)){
          $velocidadmax=0;
      }
      if(empty($velocidadmin)){
          $velocidadmin=0;
      }
        $sql="UPDATE detalleservicio_empresarial SET tipocone_emp='$tipoconex',velmax_emp='$velocidadmax',"
                . "velmin_emp='$velocidadmin',nodo_emp='$nodo_det',antena_emp='$antena_det'"
                . "WHERE cod_det_emp='$cod_det'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarIpBackEmpresariales($direccion_bak,$descripcion_bak,$cod_bak){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE direcciones_ip_bakcbone_emp SET direccionip_bak_emp='$direccion_bak',descripcion_bak_emp='$descripcion_bak' WHERE cod_bak_emp='$cod_bak'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarIpClientesEmpresariales($direccion_cli,$descripcion_cli,$cod_cli){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE direcciones_ip_clientes_emp SET direccionip_cli_emp='$direccion_cli',descripcionip_cli_emp='$descripcion_cli' WHERE cod_cli_emp='$cod_cli'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
    function ActualizarIpEquiposEmpresariales($direccion_ip,$mac_ip,$descripcion_ip,$cod_dir){
        $conexion=$this->EstablecerConexion();
        $sql="UPDATE equipos_empresas SET elemento_emp='$direccion_ip',mac_emp='$mac_ip',descripcion_emp='$descripcion_ip' WHERE cod_dir_emp='$cod_dir'";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
         
        return $query;
    }
     
     /*funciones para crear y actualizar las incidencias*/
     function VerIncidencias($tablaIncidencias,$cod_ser){
          $conexion=$this->EstablecerConexion();
          $sql="SELECT * FROM $tablaIncidencias WHERE  cod_servicio='$cod_ser' ORDER BY cod_inc Desc";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
     }
     function VerReportes($tablasoportes,$cod_inc){
           $conexion=$this->EstablecerConexion();
          $sql="SELECT * FROM $tablasoportes WHERE  cod_inc='$cod_inc' AND fechaCerrar_sop='0000-00-00' ";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
     }
     function VerSoportes($tablasoportes,$cod_inc){
          $conexion=$this->EstablecerConexion();
          $sql="SELECT * FROM $tablasoportes WHERE  cod_inc='$cod_inc' ORDER BY fechaCrear_sop desc,horaCrear_sop DESC";
         $query=  mysqli_query($conexion, $sql)or die(mysqli_error($conexion));
        return $query;
     }
       public function SelectTecnicos(){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT * FROM admin,usuario WHERE admin.rol=3  AND admin.cod_ad=usuario.admin";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
    public function SelectTecnicosInciPersonales($tablaTecnicos,$cod_soporte){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT * FROM $tablaTecnicos  WHERE cod_soporte='$cod_soporte'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
      public function SelectCodIncidencia($tablaIncidencias){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT cod_inc FROM $tablaIncidencias  ORDER BY cod_inc DESC limit 0,1";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
      public function SelectCodSoporte($tablasoportes){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT cod_sop FROM $tablasoportes  ORDER BY cod_sop DESC limit 0,1";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
     
    public function CrearIncidencias($tablaIncidencias,$cod_inc,$creador_inc,$cod_Servicio,$responsable_inc,$fechainc,$horainc){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="INSERT INTO $tablaIncidencias (`cod_inc`, `creador_inc`,`cod_servicio`, `responsable_inc`, `fecha_inc`, `hora_inc`) VALUES ('$cod_inc','$creador_inc','$cod_Servicio','$responsable_inc','$fechainc','$horainc')";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
     public function CrearSoporte($tablasoportes,$cod_sop,$descripcion_sop,$archivoCrear_sop,$archivoCerrar_sop,$fechaCrear_sop,$fechaCerrar_sop,$horaCrear_sop,$horaCerrar_sop,$solucion_sop,$cod_inc){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="INSERT INTO $tablasoportes(`cod_sop`, `descripcion_sop`, `archivoCrear_sop`, `archivoCerrar_sop`, `fechaCrear_sop`, `fechaCerrar_sop`, `horaCrear_sop`, `horaCerrar_sop`, `solucion_sop`, `cod_inc`)  VALUES ('$cod_sop','$descripcion_sop','$archivoCrear_sop','$archivoCerrar_sop','$fechaCrear_sop','$fechaCerrar_sop','$horaCrear_sop','$horaCerrar_sop','$solucion_sop','$cod_inc')";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
     
       public function InsertarTecnicos($tablatecnicos,$cod_tecnico,$cod_soporte){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="INSERT INTO $tablatecnicos (`cod_usuario`, `cod_soporte`) VALUES ('$cod_tecnico','$cod_soporte')";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
      public function ActualizarIncidencia($tablaIncidencias,$responsable_inc,$cod_inc){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="UPDATE $tablaIncidencias SET `responsable_inc`='$responsable_inc' WHERE cod_inc='$cod_inc'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
     public function ActualizarSoporte($tablasoportes,$descripcion_sop,$archivoCrear_sop,$solucion,$fechaCerrar,$horaCerrar,$archivoCerrar_sop,$cod_soporte){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="UPDATE $tablasoportes SET `descripcion_sop`='$descripcion_sop',`archivoCrear_sop`='$archivoCrear_sop',solucion_sop='$solucion',fechaCerrar_sop='$fechaCerrar',horaCerrar_sop='$horaCerrar',archivoCerrar_sop='$archivoCerrar_sop' WHERE cod_sop='$cod_soporte'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
     public function CerrarIncidencia($tablasoportes,$cod_soporte,$solucion_sop,$archivoCerrar_sop,$fechaCerrar_sop,$horaCerrar_sop){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="UPDATE $tablasoportes SET `solucion_sop`='$solucion_sop',`archivoCerrar_sop`='$archivoCerrar_sop',`fechaCerrar_sop`='$fechaCerrar_sop',`horaCerrar_sop`='$horaCerrar_sop' WHERE cod_sop='$cod_soporte'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
     
     public function  BorrarTecnicosIncidencias($tablatecnicos,$cod_soporte){
           $_conexion=$this->_conexion->EstablecerConexion();
        $sql="DELETE FROM $tablatecnicos WHERE `cod_soporte`='$cod_soporte'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
     public function SelecResponsable($documento){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT Incidencias_Personales.* FROM Incidencias_Personales WHERE Incidencias_Personales.responsable_inc='$documento'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
      public function SelecEmpresaResponsable($documento){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT * FROM Incidencias_Empresariales WHERE responsable_inc='$documento' ";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
      public function SelecOtrosTecnicos($documento){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT TecnicosInciden_Personales.*,cod_inc FROM TecnicosInciden_Personales,SoportesIncidenciasPersonales WHERE cod_usuario='$documento' AND SoportesIncidenciasPersonales.cod_sop=TecnicosInciden_Personales.cod_soporte";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
      public function SelecOtrosTecnicosEmpresa($documento){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT TecnicosInciden_Empresariales.*,cod_inc FROM TecnicosInciden_Empresariales,SoportesIncidenciasEmpresas WHERE cod_usuario='$documento' AND SoportesIncidenciasEmpresas.cod_sop=TecnicosInciden_Empresariales.cod_soporte";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
     public function SelectServiciosTecnico($cod_inc){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT Incidencias_Personales.*,SoportesIncidenciasPersonales.*,BD_tiposervicio.nombre_tp,BD_formatoscontrato.nombre_for,tiposervicio_personal.*,usuario.nombre_usu,usuario.apellido_usu FROM SoportesIncidenciasPersonales,Incidencias_Personales,tiposervicio_personal,usuario,BD_formatoscontrato,BD_tiposervicio WHERE Incidencias_Personales.cod_inc=SoportesIncidenciasPersonales.cod_inc AND tiposervicio_personal.cod_ser=Incidencias_Personales.cod_servicio AND usuario.documento_usu=Incidencias_Personales.responsable_inc AND BD_formatoscontrato.cod_for=tiposervicio_personal.formatocontrato_ser AND BD_tiposervicio.cod_tp=tiposervicio_personal.tiposervicio AND Incidencias_Personales.cod_inc='$cod_inc'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
         
     }
      public function SelectServiciosTecnicoEmpresa($cod_inc){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT Incidencias_Empresariales.*,SoportesIncidenciasEmpresas.*,BD_tiposervicio.nombre_tp,BD_formatoscontratoEmprs.nombre_forE,tiposervicio_empresarial.*,usuario.nombre_usu,usuario.apellido_usu FROM SoportesIncidenciasEmpresas,Incidencias_Empresariales,tiposervicio_empresarial,usuario,BD_formatoscontratoEmprs,BD_tiposervicio WHERE Incidencias_Empresariales.cod_inc=SoportesIncidenciasEmpresas.cod_inc AND tiposervicio_empresarial.cod_ser_emp=Incidencias_Empresariales.cod_servicio AND usuario.documento_usu=Incidencias_Empresariales.responsable_inc AND BD_formatoscontratoEmprs.cod_forE=tiposervicio_empresarial.formatocontrato_emp AND BD_tiposervicio.cod_tp=tiposervicio_empresarial.tipo_servicio_emp AND Incidencias_Empresariales.cod_inc='$cod_inc'";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
         
     }
     /**/
     /**/
     /**/
     /*Informes*/
     /**/
     /**/
     /**/
     /**/
     public function SelectCreadores(){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT * FROM admin,usuario WHERE admin.rol=2  AND admin.cod_ad=usuario.admin";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
    public function NumeroIncidenciasAbiertas($tablasoportes,$fechainicio,$fechafin){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT COUNT(cod_sop) from $tablasoportes WHERE fechaCrear_sop >= '$fechainicio' and fechaCerrar_sop <= '$fechafin' ";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
      public function NumeroIncidenciasCerradas($tablasoportes,$fechainicio,$fechafin){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT COUNT(cod_sop) from $tablasoportes WHERE fechaCrear_sop >= '$fechainicio' and fechaCerrar_sop <= '$fechafin' and solucion_sop != '' ";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
     public function InformeTotalInciPerso($num,$fechainicio,$fechafin){
         $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT cedula_cli,nombre1_cli,apellido1_cli,nombre_ubi,direccion_ubi,nombre_mun,nombre_for,numcontrato_ser,descripcion_sop,solucion_sop from BD_municipios,BD_formatoscontrato,SoportesIncidenciasPersonales,Incidencias_Personales,tiposervicio_personal,ubicacion_servicio_personal,datos_clientes_personales WHERE fechaCrear_sop >= '$fechainicio' and fechaCerrar_sop <= '$fechafin' and SoportesIncidenciasPersonales.cod_inc=Incidencias_Personales.cod_inc and Incidencias_Personales.cod_servicio=tiposervicio_personal.cod_ser and tiposervicio_personal.cod_ubicacion=ubicacion_servicio_personal.cod_ubi and tiposervicio_personal.formatocontrato_ser=BD_formatoscontrato.cod_for and ubicacion_servicio_personal.cod_persona=datos_clientes_personales.cod_cli and ubicacion_servicio_personal.municipio_ubi=BD_municipios.cod_mun order by nombre1_cli ASC,apellido1_cli ASC  $num";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
     }
     public function InformeTotalInciEmpre($num,$fechainicio,$fechafin){
        $_conexion=$this->_conexion->EstablecerConexion();
        $sql="SELECT nitcedula_emp,nombre_emp,nombreubi_emp,direccionubi_emp,nombre_mun,nombre_forE,numcontrato_emp,descripcion_sop,solucion_sop from BD_municipios,BD_formatoscontratoEmprs,SoportesIncidenciasEmpresas,Incidencias_Empresariales,tiposervicio_empresarial,ubicacion_servicio_empresarial,datos_clientes_empresariales WHERE fechaCrear_sop >= '$fechainicio' and fechaCerrar_sop <= '$fechafin' and SoportesIncidenciasEmpresas.cod_inc=Incidencias_Empresariales.cod_inc and Incidencias_Empresariales.cod_servicio=tiposervicio_empresarial.cod_ser_emp and tiposervicio_empresarial.cod_ubicacion_emp=ubicacion_servicio_empresarial.cod_ubi_emp and tiposervicio_empresarial.formatocontrato_emp=BD_formatoscontratoEmprs.cod_forE and ubicacion_servicio_empresarial.cod_empresa=datos_clientes_empresariales.cod_emp and ubicacion_servicio_empresarial.municipioubi_emp=BD_municipios.cod_mun order by nombre_emp ASC  $num";
        $query=mysqli_query($_conexion,$sql)or die(mysqli_error($_conexion));
        return $query;
    }
      
 }
?>