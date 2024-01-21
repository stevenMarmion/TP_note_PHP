<?php

namespace Classes\Form\Type;
require_once __DIR__ . "/../GeneriqueFormElement.php";


use Form\Input;

/**
 * Classe InputNumber représente un champ de saisie de type nombre dans un formulaire.
 */
class InputNumber extends Input {
    /**
     * Constructeur de la classe InputNumber.
     * 
     * @param string $id L'identifiant du champ de saisie.
     * @param string $name Le nom du champ de saisie.
     * @param mixed $value La valeur du champ de saisie.
     * @param string $label Le label du champ de saisie.
     * @param bool $required Indique si le champ de saisie est requis ou non.
     */
    public function __construct($id,$name,$value,$label,$required) {
        parent::__construct("number",$id,$name,$value,$label,$required);
    }

    /**
     * Rendu du champ de saisie.
     */
    public function render() {
        parent::render();
    }
}

?>