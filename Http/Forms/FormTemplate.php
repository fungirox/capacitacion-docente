<?php

namespace Http\Forms;

use Core\ValidationException;

abstract class FormTemplate {

    protected $errors = [];
    public array $attributes;

    public function __construct(array $attributes) {
        $this->attributes = $attributes;

        $this->validateForm();
    }

    abstract protected function validateForm();

    public static function validate($attributes) {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw() {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed() {
        return count($this->errors);
    }

    public function errors() {
        return $this->errors;
    }

    public function error($field, $message) {
        $this->errors[$field] = $message;

        return $this;
    }
}
