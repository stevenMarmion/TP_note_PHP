<?php

namespace Classes\Form\Type;
require_once __DIR__ . "/../GeneriqueFormElement.php";

use Form\Input;

/**
 * Classe InputHidden
 * 
 * Cette classe représente un champ de formulaire de type "hidden".
 * 
 * @package Classes\Form\Type
 */
class InputHidden extends Input {
    /**
     * Constructeur de la classe InputHidden
     * 
     * @param string $id L'identifiant du champ de formulaire
     * @param string $name Le nom du champ de formulaire
     * @param string $value La valeur du champ de formulaire
     * @param string $label Le label du champ de formulaire
     * @param bool $required Indique si le champ de formulaire est requis ou non
     */
    public function __construct($id,$name,$value,$label,$required) {
        parent::__construct("hidden",$id,$name,$value,$label,$required);
    }

    /**
     * Rendu du champ de formulaire
     */
    public function render() {
        parent::render();
    }
}

?>