<?php

namespace Http\Forms;

use Core\Validator;

class AreaForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::string($this->attributes["nombre"], 1, 100)) {
            $this->errors['nombre'] = "Favor de introducir el nombre del área.";
        }

        if (!Validator::string($this->attributes["siglas"], 1, 5)) {
            $this->errors['siglas'] = "Favor de introducir las siglas del área.";
        }
    }
}
