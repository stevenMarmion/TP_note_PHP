<?php

namespace Form;

/**
 * Interface Irender
 * 
 * Cette interface définit la méthode render() qui doit être implémentée par les classes de rendu d'entrée de formulaire.
 */
interface Irender {
    /**
     * Rendre l'entrée de formulaire.
     *
     * @return string Le code HTML représentant l'entrée de formulaire.
     */
    public function render();
}

?>