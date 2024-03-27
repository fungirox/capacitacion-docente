<?php
/** ITESCA - Coordinacion de Desarrollo de Software **/
  
include("clsConfig.php");
class clsSqlsrv
{
   public $user;
   public $pass;
   public $dbhost;
   public $dbname;
   public $sqlsrv_conn; // Database connection handle

   public $DEPURAR;
   
   public $qq; // query para mostrar en pantalla, depurar.
   public $MQ; // bandera para mostrar los query o no mostrarlos

   public function __construct()
   {  
      $objConfig = new clsConfig();
	  
      $this->user = $objConfig->BD_USER;
      $this->pass = $objConfig->BD_PWS;
      $this->dbhost = $objConfig->BD_HOST;
      $this->dbname = $objConfig->BD_DB;
      $this->DEPURAR =  $objConfig->DEPURAR;
      $this->MQ = false;
      $this->conectar();
   }

   /**
    * conectar el objeto con la base de datos
    * @return int: 1,0 conexion exitosa, fallida
    */
   public function conectar()
   {
   try {
			$this->sqlsrv_conn = new PDO("sqlsrv:server=$this->dbhost;Database=$this->dbname;" , "$this->user", "$this->pass");
    } catch (PDOException $e) { die( print_r( $e->getMessage() ) );   	
    }
   }

   public function close()
   {
   		$this->sqlsrv_conn = null;
   }

   public function generateCallTrace()
   {
       if($this->DEPURAR || $this->MQ)
       {
          $e = new Exception();
          $trace = explode("\n", $e->getTraceAsString());
          // reverse array to make steps line up chronologically
          $trace = array_reverse($trace);
          array_shift($trace); // remove {main}
          array_pop($trace); // remove call to this method
          $length = count($trace);
          $result = array();
          
          for ($i = 0; $i < $length; $i++)
          {
              $result[] =  substr($trace[$i], strpos($trace[$i], ' ')); 
          }
          
        return "<span style='color:#C20E0E'><b>"."\t" . implode("\n\t", $result)."</b></span>\")";
      }else{ return ""; }
   }
     
   public function mostrarQuery()
   {
	   if(is_array($this->params))
         foreach($this->params as $index=>&$value)
			$this->qq.= "'".$value."',";
       else if($this->params!="")
	   	$this->qq.="'".$this->params."',"; 
		 
		$this->qq = substr($this->qq,0,(strlen($this->qq)-1)); 
		echo "<span style='color:#8E1345'><b>".$this->qq."</b></span>"; 
   }	
   
    /**
    * Ejecutar un procedimiento almacenado(SP) de la base de datos
    * de manera segura, con , prepare function, para evitar sqlInjection
    * @param string $SP: nombre del procedimiento almacenado (SP)
    * @param ARRAY $params: parametros del SP
    * @return $rs
    */
   public function ejecutaSPSafe($SP, $params=array(),$MQ=false)
   {

     try { 
       $query = "EXEC ".$SP." ";
       $this->MQ = $MQ;
       $this->qq = $query;
       $this->params = $params;

       if(is_array($params))
       {
         foreach($params as $index=>$value)
         {
            $query.="?,";
         }
          $query = substr($query,0,(strlen($query)-1)); 
       }
       else if($params!=""){$query.="?"; }  
                                           
       $query.=" ";  
    
 	    $i = 1;
	    $stmt = $this->sqlsrv_conn->prepare($query); 
	    if(is_array($params))
        {
          foreach($params as $index=>&$value)
          {	
		 	 $stmt->bindParam($i, $value, PDO::PARAM_STR);
             $i+=1;
          }
        }
         else if($params!=""){ $stmt->bindParam($i,$params, PDO::PARAM_STR); } 
	  
		  $stmt->execute();
		  $rs = $stmt->fetchAll();

        if($this->DEPURAR || $this->MQ)$this->mostrarQuery();
        
     
		  return $rs;

      }catch (Exception $e) { echo  $e->getMessage();  } 

    
   }//fin funcion ejecutaSPSafe
 
}
?>