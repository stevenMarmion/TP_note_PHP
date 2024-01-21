<?php

declare(strict_types=1);

namespace Form;

require_once __DIR__ . "/InputRenderInterface.php";

/**
 * Classe abstraite représentant un élément de formulaire générique.
 */
abstract class Input implements Irender {
    protected string $type;
    protected string $id;
    protected string $name;
    protected string $value = " ";
    protected string $label;
    protected bool $required;

    /**
     * Constructeur de la classe Input.
     *
     * @param string $type Le type de l'élément de formulaire.
     * @param string $id L'identifiant de l'élément de formulaire.
     * @param string $name Le nom de l'élément de formulaire.
     * @param string $value La valeur de l'élément de formulaire.
     * @param string $label Le label de l'élément de formulaire.
     * @param bool $required Indique si l'élément de formulaire est requis ou non.
     */
    public function __construct($type, $id, $name, $value, $label, $required) {
        $this->type = $type;
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->required = $required;
    }

    /**
     * Retourne le type de l'élément de formulaire.
     *
     * @return string Le type de l'élément de formulaire.
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Retourne l'identifiant de l'élément de formulaire.
     *
     * @return string L'identifiant de l'élément de formulaire.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Retourne le nom de l'élément de formulaire.
     *
     * @return string Le nom de l'élément de formulaire.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Retourne la valeur de l'élément de formulaire.
     *
     * @return string La valeur de l'élément de formulaire.
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Retourne le label de l'élément de formulaire.
     *
     * @return string Le label de l'élément de formulaire.
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * Indique si l'élément de formulaire est requis ou non.
     *
     * @return string La chaîne "required" si l'élément est requis, sinon une chaîne vide.
     */
    public function isRequired() {
        return $this->required ? "required" : " ";
    }

    /**
     * Méthode abstraite pour générer le rendu de l'élément de formulaire.
     */
    public abstract function render();
}

?>