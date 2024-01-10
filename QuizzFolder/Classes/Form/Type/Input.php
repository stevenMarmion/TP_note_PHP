<?php
declare (strict_types = 1);

namespace QuizzFolder\Classes\Form\Type;

use QuizzFolder\Classes\Form\GenericFormElement;

abstract class Input extends GenericFormElement {
    public function render(): string {
        return sprintf('<input type="%s" %s value="%s" name="%s">',
        $this->type,
        $this->isRequired() ? 'required="required"' : '',
        $this->getValue(),
        $this->getName(),
    );
    }
}