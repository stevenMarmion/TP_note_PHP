<?php

declare(strict_types=1);

namespace Form;

require_once __DIR__ . "/InputRenderInterface.php";

abstract class Input implements Irender {
    protected string $type;
    protected string $id;
    protected string $name;
    protected string $value = " ";
    protected string $label;
    protected bool $required;

    public function __construct($type, $id, $name, $value, $label, $required) {
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->required = $required;
    }

    public function getType() {
        return $this->type;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function getLabel() {
        return $this->label;
    }

    public function isRequired() {
        return $this->required ? "required" : " "; // ? reponse si true : reponse si false
    }

    public abstract function render();
}

?>