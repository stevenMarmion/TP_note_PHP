<?php

namespace Classes\Form\Type;

require_once __DIR__ . "/../GeneriqueFormElement.php";

use Form\Input;

class InputText extends Input {
    public function __construct($id,$name,$value,$label,$required) {
        parent::__construct("text",$id,$name,$value,$label,$required);
    }

    public function render() {
        $input = "<input type='" . $this->getType() . "' name='" . $this->getName() . "' id='". $this->getId() . "' </input>"; 
        return $input;
    }
}

?>