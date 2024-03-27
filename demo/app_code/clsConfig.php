<?PHP
 class clsConfig {
       public $BD_HOST;     
       public $BD_USER; 
       public $BD_PWS;  
       public $BD_DB; 
	   
	  public function __construct() {
		$this->BD_HOST = "";  // servidor 
		$this->BD_USER = "";  // usuario de la base de datos
		$this->BD_PWS = ""; // password
		$this->BD_DB = "dbDemo"; // base de datos
		$this->DEPURAR = false; // depurar
	  }	
}
?>


