<?php

use Core\App;
use Core\Repositories\UsuarioRepository;

App::resolve(UsuarioRepository::class)->delete($_POST["id"]);

redirect("/admin/usuarios");
