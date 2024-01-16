<?php

namespace Classes\Form\Type;

require_once __DIR__ . "/../GeneriqueFormElement.php";

use \Form\Input;

class InputCheckbox extends Input {
    public function __construct($id,$name,$value,$label,$required) {
        parent::__construct("checkbox",$id,$name,$value,$label,$required);
    }

    public function render() {
        $label = "<label for='" . $this->getLabel() . "'>" . $this->getValue() . " : </label>";
        $input = "<input type='" . $this->getType() . "' name='" . $this->getName() . "[]' id='". $this->getId() . "' value='" . $this->getValue() . "' </input>"; 
        return $input . $label;
    }
}

?>