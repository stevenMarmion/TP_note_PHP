<?php

namespace Classes\Form\Type;

require_once __DIR__ . "/../GeneriqueFormElement.php";

use \Form\Input;

/**
 * Classe InputRadio
 * 
 * Représente un élément de formulaire de type radio.
 */
class InputRadio extends Input {
    /**
     * Constructeur de la classe InputRadio.
     * 
     * @param string $id L'identifiant de l'élément.
     * @param string $name Le nom de l'élément.
     * @param string $value La valeur de l'élément.
     * @param string $label Le label de l'élément.
     * @param bool $required Indique si l'élément est requis ou non.
     */
    public function __construct($id,$name,$value,$label,$required) {
        parent::__construct("radio",$id,$name,$value,$label,$required);
    }

    /**
     * Rendu de l'élément de formulaire.
     * 
     * @return string Le code HTML représentant l'élément de formulaire.
     */
    public function render() {
        $label = "<label for='" . $this->getLabel() . "'>" . $this->getValue() . " : </label>";
        $input = "<input type='" . $this->getType() . "' name='" . $this->getName() . "[]' id='". $this->getId() . "' value='" . $this->getValue() . "' </input>"; 
        return $label . $input;
    }
}

?>