<script src="modulos/crud/crud.js"></script>

<h4 class="text-tec" align="center">
    <i class="fa-solid fa-edit"></i>
    Captura de nuevo registro
</h4>

<div class="row justify-content-md-center">
    <div class="col col-sm-12  col-md-4 col-lg-4">
        <div class="mt-3">
            <div class="mb-3">
                <label for="txtNombre" class="form-label"><strong>Nombre</strong></label>
                <input type="text" class="form-control" id="txtNombre" placeholder="Nombre completo">
            </div>
            <div class="mb-3">
                <label for="txtEmail" class="form-label"><strong>Email</strong></label>
                <input type="text" class="form-control" id="txtEmail" placeholder="ej. user@dominio.com">
            </div>
            <div class="mb-3">
                <label for="txtTelefono" class="form-label"><strong>Teléfono</strong></label>
                <input type="text" class="form-control" id="txtTelefono" placeholder="10 dígitos">
            </div>          
            <div class="mb-3">
                <span class="float-end text-success" id="spSuccess" style="display:none;">
                    <i class="fa-solid fa-check-circle"></i>
                    Guardado con éxito.
                </span>
                <button type="button" class="btn btn-success" onclick="guardarRegistro();">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Guardar Registro
                </button>
            </div>    
       </div>
    </div>
</div>

<div class="mt-3 alert alert-danger w-50" id="dvErrorCaptura" role="alert" style="display:none; margin:0 auto;">
    <i class="fa-solid fa-info-circle"></i>
    <strong>Importante!</strong> Todos los campos son obligatorios.
</div>