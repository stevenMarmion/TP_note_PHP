<?php

require_once __DIR__ . '/connexionBD.php';

date_default_timezone_set('Europe/Paris');

function recup_datas_quizz() : array {
    try {
        $db = creer_connexion_BDD();
        $recup_all = recup_quizz($db); 
        $liste_quizz = recup_nom_quizz($recup_all);
        return $liste_quizz;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return null;
    }
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