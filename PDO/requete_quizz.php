<?php

date_default_timezone_set('Europe/Paris');

try {
    $db = creer_connexion_BDD();
    $recup_all = recup_quizz($db); 
    $liste_quizz = recup_nom_quizz($recup_all);
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

function recup_quizz($db) {
    return $db->query('SELECT * FROM Quizz');
}

function recup_nom_quizz($data) {
    $liste_quizz = [];
    foreach ($data as $key) {
        $liste_quizz[] = $key['name_quizz'];
    }
    return $liste_quizz;
}
?>