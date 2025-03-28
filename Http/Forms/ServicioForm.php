<?php

namespace Http\Forms;

use Core\Validator;
use DateTime;

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

        if (!Validator::areasAreValid($this->attributes["areas"])) {
            $this->errors["areas"] = "Favor de seleccionar al menos un área.";
        }

        if (!Validator::bit($this->attributes["perfil"])) {
            $this->errors["perfil"] = "Favor de seleccionar un perfil válido.";
        }

        if (!Validator::modalidadIsValid($this->attributes["modalidad"])) {
            $this->errors["modalidad"] = "Favor de seleccionar una modalidad válida.";
        }

        if (!Validator::date($this->attributes["fechaInicial"])) {
            $this->errors["fechaInicial"] = "Favor de introducir una fecha de inicio válida.";
        } else {
            $fechaInicial = new DateTime($this->attributes["fechaInicial"]);
            $currentDate = new DateTime();
            if ($fechaInicial < $currentDate) {
                $this->errors["fechaInicial"] = "La fecha de inicio no puede ser una fecha pasada.";
            }
        }

        if (!Validator::date($this->attributes["fechaFinal"])) {
            $this->errors["fechaFinal"] = "Favor de introducir una fecha de finalización válida.";
        } else {
            $fechaInicial = new DateTime($this->attributes["fechaInicial"]);
            $fechaFinal = new DateTime($this->attributes["fechaFinal"]);
            if ($fechaFinal <= $fechaInicial) {
                $this->errors["fechaFinal"] = "La fecha de finalización debe ser posterior a la fecha de inicio.";
            }
        }

        if (!Validator::numeric($this->attributes["horasTotal"])) {
            $this->errors["horasTotal"] = "Favor de introducir un número de horas válido.";
        }

        if (!Validator::bit($this->attributes["externo"])) {
            $this->errors["externo"] = "Favor de seleccionar un valor válido para el campo externo.";
        }

        if (strcmp($this->attributes["modalidad"], "virtual") !== 0) {
            if (!Validator::string($this->attributes["aula"], 1)) {
                $this->errors["aula"] = "Favor de introducir un aula válida.";
            }

            if (!Validator::daysAreValid($this->attributes["dias"])) {
                $this->errors["dias"] = "Favor de seleccionar al menos un día de la semana.";
            }

            if (!Validator::time($this->attributes["horaInicial"])) {
                $this->errors["horaInicial"] = "Favor de introducir una hora de inicio válida.";
            }

            if (!Validator::time($this->attributes["horaFinal"])) {
                $this->errors["horaFinal"] = "Favor de introducir una hora de finalización válida.";
            } else {
                $horaInicial = new DateTime($this->attributes["horaInicial"]);
                $horaFinal = new DateTime($this->attributes["horaFinal"]);
                if ($horaFinal <= $horaInicial) {
                    $this->errors["horaFinal"] = "La hora de finalización debe ser posterior a la hora de inicio.";
                }
            }

            if (!Validator::numeric($this->attributes["limite"])) {
                $this->errors["limite"] = "Favor de introducir un número de cupo válido.";
            }
        }

        if (strcmp($this->attributes["modalidad"], "mixto") === 0) {
            if (!Validator::numeric($this->attributes["horasPresenciales"])) {
                $this->errors["horasPresenciales"] = "Favor de introducir un número de horas presenciales válido.";
            } else {
                if ($this->attributes["horasPresenciales"] > $this->attributes["horasTotal"]) {
                    $this->errors["horasPresenciales"] = "Las horas presenciales no pueden ser mayores al total de horas.";
                }
            }
        }
    }
}
