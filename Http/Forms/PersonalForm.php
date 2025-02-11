<?php

namespace Http\Forms;

use Core\Validator;

class PersonalForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::string($this->attributes["nombre"])) {
            $this->errors['nombre'] = "Favor de introducir un nombre completo.";
        }

        if (!Validator::string($this->attributes["puesto"])) {
            $this->errors['puesto'] = "Favor de introducir un puesto.";
        }

        if (!Validator::string($this->attributes["titulo"])) {
            $this->errors['titulo'] = "Favor de seleccionar un título.";
        }
    }
}
