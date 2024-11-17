<?php

namespace Http\Forms;

use Core\Validator;

class CarreraForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::string($this->attributes["nombre"], 1, 100)) {
            $this->errors['nombre'] = "Favor de introducir el nombre de la carrera.";
        }

        if (!Validator::string($this->attributes["siglas"], 1, 8)) {
            $this->errors['siglas'] = "Favor de introducir las siglas de la carrera.";
        }
    }
}
