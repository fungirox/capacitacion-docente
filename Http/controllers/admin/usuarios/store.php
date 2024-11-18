<?php

use Core\App;
use Core\Database;
use Core\Repositories\UsuarioRepository;
use Http\Forms\UsuarioForm;

$form = UsuarioForm::validate($attributes = [
    "rol" => $_POST["rol"],
    "username" => $_POST["username"],
    "genero" => $_POST["genero"],
    "nombre" => $_POST["nombre"],
    "apellido" => $_POST["apellido"],
    "email" => $_POST["email"],
    "contraseña" => $_POST["contraseña"],
    "confirmarContraseña" => $_POST["confirmar-contraseña"],
    "baseOrHoras" => $_POST["base-horas"],
    "horasBase" => $_POST["horas-base"],
    "isDocenteInstructor" => isset($_POST["docente-instructor"]) ? $_POST["docente-instructor"] : "0",
]);

$usuarioRepository = App::resolve(UsuarioRepository::class);

if ($usuarioRepository->getByUsername($attributes["username"])) {
    $form->error(
        "username",
        "Ya existe un usuario con ese nombre de usuario/nómina"
    )->throw();
}

$usuarioRepository->createUsuario($attributes);

$userId = $usuarioRepository->getDatabase()->lastInsertId();

switch ($attributes["rol"]) {
    case "docente":
        $usuarioRepository->createDocente([
            "userId" => $userId,
            "username" => $attributes["username"],
            "baseOrHoras" => $attributes["baseOrHoras"],
            "horasBase" => $attributes["horasBase"]
        ]);
        if ($isDocenteInstructor) {
            $usuarioRepository->createInstructor($userId);
        }
        break;
    case "instructor":
        $usuarioRepository->createInstructor($userId);
        break;
    case "administrador":
        $usuarioRepository->createAdministrador($userId);
        break;
};

redirect("/admin/usuarios");
