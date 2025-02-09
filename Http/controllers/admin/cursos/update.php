<?php

use Core\App;
use Core\Repositories\CursoRepository;
use Http\Forms\ServicioForm;

ServicioForm::validate($attributes = [
    "id" => trim($_POST["id"]),
    "tipo" => trim($_POST["tipo"]),
    "nombre" => trim($_POST["nombre"]),
    "descripcion" => trim($_POST["descripcion"]),
    "instructor" => trim($_POST["instructor"]),
    "areas" => isset($_POST["areas"]) ? $_POST["areas"] : [],
    "perfil" => trim($_POST["perfil"]),
    "modalidad" => trim($_POST["modalidad"]),
    "fechaInicial" => trim($_POST["fecha-inicial"]),
    "fechaFinal" => trim($_POST["fecha-final"]),
    "horasTotal" => trim($_POST["horas-total"]),
    "horasPresenciales" => trim($_POST["horas-presenciales"]),
    "aula" => trim($_POST["aula"]),
    "dias" => isset($_POST["dias"]) ? $_POST["dias"] : null,
    "horaInicial" => trim($_POST["hora-inicial"]),
    "horaFinal" => trim($_POST["hora-final"]),
    "limite" => trim($_POST["limite"]),
    "externo" => isset($_POST["externo"]) ? $_POST["externo"] : "0"
]);

App::resolve(CursoRepository::class)->update($attributes);

redirect("/admin/cursos/curso?id=$attributes[id]");
