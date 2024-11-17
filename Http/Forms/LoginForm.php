<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::string($this->attributes["username"])) {
            $this->errors["username"] = "Favor de introducir un nombre de usuario.";
        }

        if (!Validator::string($this->attributes["password"])) {
            $this->errors["password"] = "Favor de introducir una contraseña.";
        }
    }
}
