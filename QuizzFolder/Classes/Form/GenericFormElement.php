<?php
declare (strict_types = 1);

namespace QuizzFolder\Classes\Form;

abstract class GenericFormElement implements InputRenderInterface{
    protected string $type;
    protected bool $required = false;
    protected mixed $value = '';


    public function __construct(protected readonly string $name, $required = false, string $defaultvalue = '') {
        $this->required = $required;
        $this->value = $defaultvalue;
    }

    public function  __toString(): string {
        return $this->render();
    }

    public function render(): string {
        $required = $this->required ? 'required' : '';
        return "<input type='$this->type' name='$this->name' value='$this->value' $required>";
    }

    public function getValue(): mixed {
        return $this->value;
    }

    public function setValue(mixed $value): void {
        $this->value = $value;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function isRequired(): bool {
        return $this->required;
    }

    public function setRequired(bool $required): void {
        $this->required = $required;
    }

    public function setDefault(string $default): void {
        $this->value = $default;
    }

    public function getDefault(): string {
        return $this->value;
    }
}