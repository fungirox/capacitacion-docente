<?php
view("components/header.php", ["title" => isset($title) ? $title : "Página no encontrada"]);
view("components/navbar.php");
