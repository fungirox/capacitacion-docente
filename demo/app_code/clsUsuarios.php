<?php
require_once("clsSqlsrvPDO.php"); // requiere la clase para base de datos

class clsUsuarios {
   public $objSqlsrv;

  //Constructor
   public function __construct(){
     $this->objSqlsrv = new clsSqlsrv();
   }

   // Consulta de usuario por ID
   public function getDatosUsuario($user, $MQ=false){
      return $this->objSqlsrv->ejecutaSPSafe('dbDemo..sp_getUsuariobyID', array($user), $MQ); //se manda un array con parametros en el mismo orden que el SP los espera
   }
  
   // Listar usuarios de la base de datos
   public function getUsuarios($MQ=false){
      return $this->objSqlsrv->ejecutaSPSafe('dbDemo..sp_getUsuarios', array(), $MQ); //se manda un array vacio cuando no hay parametros
   }

   // guarda un usuario en la base de datos
   public function guardarUsuarios($sNombre, $sEmail, $sTelefono, $MQ=false){
      $this->objSqlsrv->ejecutaSPSafe('dbDemo..sp_RegistraUsuario', array($sNombre, $sEmail, $sTelefono), $MQ);
   }

   // eliminar un usuario en la base de datos
   public function eliminarUsuario($sID, $MQ=false){
      $this->objSqlsrv->ejecutaSPSafe('dbDemo..sp_EliminarUsuario', array($sID), $MQ);
   }

   // Actualizar un usuario en la base de datos
   public function actualizarUsuario($sID, $sNombre, $sEmail, $sTelefono, $MQ=false){
      $this->objSqlsrv->ejecutaSPSafe('dbDemo..sp_ActualizaUsuario', array($sID, $sNombre, $sEmail, $sTelefono), $MQ);
   }
}