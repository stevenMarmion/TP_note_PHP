<?php

date_default_timezone_set('Europe/Paris');

try {
    $db = creer_connexion_BDD();
    $recup_all = recup_choix($db); 
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


function creer_connexion_BDD() {
    $db = new PDO('sqlite:quizz.sqlite3');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo PHP_EOL . 'Connexion réussie' . PHP_EOL;
    return $db;
}

function recup_choix($db) {
    return $db->query('SELECT * FROM Choix');
}
?>