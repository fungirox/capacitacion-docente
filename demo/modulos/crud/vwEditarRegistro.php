<?php 
    require_once("../../app_code/clsUsuarios.php");
    $user = $_POST["ID"];
    $rs = (new clsUsuarios())->getDatosUsuario($user);
?>

<h4 class="text-tec" align="center">
    <i class="fa-solid fa-edit"></i>
    Actualización de registro usuario
</h4>
<?php
    if (!$rs){
?>
        <h4 align="center" class="text-danger mt-3">
            No se encontraron datos sobre este usuario, intenta nuevamente.
        </h4>
<?php
        die();
    }
?>

<div class="mt-3">
    <div class="mb-3">
        <label for="txtNombre" class="form-label"><strong>Nombre</strong></label>
        <input type="text" class="form-control" id="txtNombre" value="<?=$rs[0]["USER_Nombre"]?>" placeholder="Nombre completo">
    </div>
    <div class="mb-3">
        <label for="txtEmail" class="form-label"><strong>Email</strong></label>
        <input type="text" class="form-control" id="txtEmail" value="<?=$rs[0]["USER_Email"]?>" placeholder="ej. user@dominio.com">
    </div>
    <div class="mb-3">
        <label for="txtTelefono" class="form-label"><strong>Teléfono</strong></label>
        <input type="text" class="form-control" id="txtTelefono" maxlength="10" value="<?=$rs[0]["USER_Telefono"]?>" placeholder="10 dígitos">
    </div>          
    <div class="mb-3">
        <span class="float-end text-success" id="spSuccess" style="display:none;">
            <i class="fa-solid fa-check-circle"></i>
            Guardado con éxito.
        </span>
        <button type="button" class="btn btn-success" onclick="actualizarRegistro('<?=$user?>');" data-bs-dismiss="modal">
            <i class="fa-solid fa-floppy-disk"></i>
            Actualizar Registro
        </button>
    </div>    
</div>

<div class="mt-3 alert alert-danger w-50" id="dvErrorCaptura" role="alert" style="display:none; margin:0 auto;">
    <i class="fa-solid fa-info-circle"></i>
    <strong>Importante!</strong> Todos los campos son obligatorios.
</div>