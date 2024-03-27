<?php 
    require_once("../../app_code/clsUsuarios.php");
    $rs = (new clsUsuarios())->getUsuarios();    
?>
<script src="modulos/crud/crud.js"></script>

<div class="container-fluid table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr bgColor="#EBF5FB">
                <th width="5%">ID</th>            
                <th width="45%">Nombre</th>
                <th width="30%">Email</th>
                <th width="10%">Teléfono</th>
                <td width="10%" class="fw-bold" align="center">Acciones</td>
            </tr>
        </thead>
        <tbody>
<?php 
    if ($rs){
        foreach($rs as $usuario){
?>
        <tr>
            <td><?=$usuario["USERID"]?></td>            
            <td><?=$usuario["USER_Nombre"]?></td>
            <td><?=$usuario["USER_Email"]?></td>
            <td><?=$usuario["USER_Telefono"]?></td>
            <td align="center">
                <button class="me-2 btn btn-outline-danger btn-sm" onclick="eliminarUsuario('<?=$usuario["USERID"]?>'); return false;">
                    <i class="fa-solid fa-user-xmark"></i>
                </button>

                <button class="me-2 btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#dvModal" onclick="showEditUser('<?=$usuario["USERID"]?>');">
                    <i class="fa-solid fa-user-pen"></i>
                </button>
            </td>
        </tr>
<?php
        } //foreach
    }else{ //else $rs
?>
        <tr>
            <td colspan="6" class="fs-4 text-center">
                No existen registros.
            </td>
        </tr>
<?php  
    } //if $rs
?>        
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="dvModal" tabindex="-1" aria-labelledby="dvModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-light rounded-top">
        <h1 class="modal-title fs-5" id="dvModalLabel">
            <strong>Editar Registro</strong>
        </h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="dvModalBody"></div>
    </div>
  </div>
</div>