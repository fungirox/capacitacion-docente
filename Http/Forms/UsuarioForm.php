<?php

namespace Http\Forms;

use Core\Validator;

class UsuarioForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::string($this->attributes["username"])) {
            $this->errors["username"] = "Favor de introducir un nombre de usuario/nómina válido.";
        }

        if (!Validator::string($this->attributes["nombre"])) {
            $this->errors["nombre"] = "Favor de introducr un nombre válido";
        }

        if (!Validator::string($this->attributes["apellido"])) {
            $this->errors["apellido"] = "Favor de introducr un apellido válido";
        }

        if (!Validator::email($this->attributes["email"])) {
            $this->errors["email"] = "Favor de introducr un email válido";
        }

        if (!Validator::string($this->attributes["contraseña"])) {
            $this->errors["contraseña"] = "Favor de introducir una contraseña válida.";
        }

        if (strcmp($this->attributes["contraseña"], $this->attributes["confirmarContraseña"]) !== 0) {
            $this->errors["confirmarContraseña"] = "Las contraseñas no coincíden.";
        }
    }
}
