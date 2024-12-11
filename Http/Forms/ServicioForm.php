<?php

namespace Http\Forms;

use Core\Validator;

class ServicioForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::servicio($this->attributes["tipo"])) {
            $this->errors['tipo'] = "Favor de seleccionar un tipo de servicio válido.";
        }

        if (!Validator::string($this->attributes["nombre"], 1, 100)) {
            $this->errors['nombre'] = "Favor de introducir el nombre del servicio.";
        }

        if (!Validator::string($this->attributes["descripcion"], 1, 100)) {
            $this->errors['descripcion'] = "Favor de introducir una descripción para el servicio.";
        }

        // if (!Validator::string($this->attributes["siglas"], 1, 5)) {
        //     $this->errors['siglas'] = "Favor de introducir las siglas del área.";
        // }
    }
}
