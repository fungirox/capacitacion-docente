<?php
    // Obtener las variables //  
    $sID = $_POST["ID"];
    $sNombre = $_POST["Nombre"];
    $sEmail = $_POST["Email"];
    $sTelefono = $_POST["Telefono"];
    
    require_once("../../app_code/clsUsuarios.php");
    (new clsUsuarios())->actualizarUsuario($sID, $sNombre, $sEmail, $sTelefono);
?>