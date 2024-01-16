<?php

namespace Classes\Form\Type;

use Form\Input;

//require_once "../GeneriqueFormElement.php";
class InputHidden extends Input {
    public function __construct($id,$name,$value,$label,$required) {
        parent::__construct("hidden",$id,$name,$value,$label,$required);
    }

    public function render() {
        parent::render();
    }
}

?>