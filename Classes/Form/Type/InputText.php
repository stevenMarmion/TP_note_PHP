<?php

namespace Classes\Form\Type;

require_once __DIR__ . "/../GeneriqueFormElement.php";

use Form\Input;

/**
 * Classe InputText
 * 
 * Représente un champ de texte dans un formulaire.
 */
class InputText extends Input {
    /**
     * Constructeur de la classe InputText.
     * 
     * @param string $id L'identifiant du champ de texte.
     * @param string $name Le nom du champ de texte.
     * @param string $value La valeur du champ de texte.
     * @param string $label Le label du champ de texte.
     * @param bool $required Indique si le champ de texte est requis ou non.
     */
    public function __construct($id,$name,$value,$label,$required) {
        parent::__construct("text",$id,$name,$value,$label,$required);
    }

    /**
     * Rendu du champ de texte.
     * 
     * @return string Le code HTML représentant le champ de texte.
     */
    public function render() {
        $input = "<input type='" . $this->getType() . "' name='" . $this->getName() . "' id='". $this->getId() . "' </input>"; 
        return $input;
    }
}

?>