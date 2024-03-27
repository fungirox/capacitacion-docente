<?php
    // Obtener las variables //  
    $sNombre = $_POST["Nombre"];
    $sEmail = $_POST["Email"];
    $sTelefono = $_POST["Telefono"];
    
    require_once("../../app_code/clsUsuarios.php");
    (new clsUsuarios())->guardarUsuarios($sNombre, $sEmail, $sTelefono);
?>