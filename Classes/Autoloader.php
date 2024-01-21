<?php

/**
 * Classe AutoLoader
 * 
 * Cette classe permet de charger automatiquement les classes PHP enregistrées.
 */
class AutoLoader {

    /**
     * Enregistre la fonction d'autoloading.
     * 
     * Cette méthode enregistre la fonction d'autoloading de la classe AutoLoader.
     * Elle est appelée une seule fois pour initialiser l'autoloading.
     *
     * @return void
     */
    static function register() {
        sql_autoload_register(array(__CLASS__, "autoload"));
    }

    /**
     * Autoload une classe.
     * 
     * Cette méthode est appelée automatiquement lorsqu'une classe est utilisée
     * et n'est pas encore chargée. Elle permet de charger la classe en incluant
     * le fichier correspondant.
     *
     * @param string $class Le nom de la classe à charger.
     * @return string|void Le chemin du fichier de la classe ou rien si le fichier n'existe pas.
     */
    static function autoload($class) {
        $path = str_replace("\\","/", $class);
        return "Classes/".$path.".php";
    }

    /**
     * Autoload une classe.
     * 
     * Cette méthode est utilisée pour charger une classe en incluant le fichier
     * correspondant. Elle est appelée par la fonction d'autoloading.
     *
     * @param string $class Le nom de la classe à charger.
     * @return void
     */
    function sql_autoload_register($class) {
        $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
}

?>