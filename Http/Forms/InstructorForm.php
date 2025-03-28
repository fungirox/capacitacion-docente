<?php

namespace Http\Forms;

use Core\Validator;

class InstructorForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::string($this->attributes["nombre"])) {
            $this->errors['nombre'] = "Favor de introducir un nombre válido.";
        }

        if (!Validator::string($this->attributes["apellido"])) {
            $this->errors['apellido'] = "Favor de introducir un apellido válido.";
        }

        if (!Validator::string($this->attributes["username"])) {
            $this->errors['username'] = "Favor de introducir un nombre de usuario válido.";
        }

        if ($this->attributes["edit"]) {
            if (!Validator::updateUsername($this->attributes["id"], $this->attributes["username"])) {
                $this->errors['username'] = "Un usuario con ese nombre de usuario ya existe.";
            }
        } else {
            if (!Validator::username($this->attributes["username"])) {
                $this->errors['username'] = "Un usuario con ese nombre de usuario ya existe.";
            }
        }

        if (!Validator::email($this->attributes["email"])) {
            $this->errors['email'] = "Favor de introducir un correo electrónico válido.";
        }

        if (!Validator::bit($this->attributes["genero"])) {
            $this->errors['genero'] = "Favor de seleccionar un género válido.";
        }

        if (!Validator::nivelDeEstudios($this->attributes["estudios"])) {
            $this->errors['estudios'] = "Favor de seleccionar un nivel de estudios válido.";
        }

        if (!$this->attributes["edit"] || $this->attributes["edit"] && $this->attributes["updatePassword"]) {
            if (!Validator::string($this->attributes["password"], 5)) {
                $this->errors['password'] = "La contraseña debe tener al menos 5 caracteres.";
            }

            if ($this->attributes["password"] !== $this->attributes["confirmPassword"]) {
                $this->errors['confirmPassword'] = "Las contraseñas no coinciden.";
            }
        }
    }
}
