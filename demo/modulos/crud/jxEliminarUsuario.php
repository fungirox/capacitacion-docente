<?php
    $sID = $_POST["ID"];
    
    require_once("../../app_code/clsUsuarios.php");
    (new clsUsuarios())->eliminarUsuario($sID);
?>