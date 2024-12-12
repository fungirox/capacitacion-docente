<?php

namespace Http\Forms;

use Core\Validator;

class ServicioForm extends FormTemplate {

    protected function validateForm() {
        if (!Validator::tipoDeServicio($this->attributes["tipo"])) {
            $this->errors["tipo"] = "Favor de seleccionar un tipo de servicio válido.";
        }

        if (!Validator::string($this->attributes["nombre"], 1, 100)) {
            $this->errors["nombre"] = "Favor de introducir el nombre del servicio.";
        }

        if (!Validator::string($this->attributes["descripcion"], 1)) {
            $this->errors["descripcion"] = "Favor de introducir una descripción para el servicio.";
        }

        if (!Validator::isValidInstructor($this->attributes["instructor"])) {
            $this->errors["instructor"] = "Favor de seleccionar un instructor de la lista.";
        }
    }
}
