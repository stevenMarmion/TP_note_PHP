<?php

require_once __DIR__ . '/connexionBD.php';

date_default_timezone_set('Europe/Paris');

function recup_datas_choix() : PDOStatement {
    try {
        $db = creer_connexion_BDD();
        $recup_all = recup_choix($db); 
        return $recup_all;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return null;
    }
}


function creer_connexion_BDD() {
    $cheminFichierSQLite = __DIR__ . '/../quizz.sqlite3';
    $db = new PDO('sqlite:' . $cheminFichierSQLite);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo PHP_EOL . 'Connexion réussie' . PHP_EOL;
    return $db;
}

function recup_choix($db) {
    return $db->query('SELECT * FROM Choix');
}
?>