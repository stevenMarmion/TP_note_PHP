<?php

require_once __DIR__ . '/connexionBD.php';

date_default_timezone_set('Europe/Paris');

function recup_datas_questions() : PDOStatement {
    try {
        $db = creer_connexion_BDD();
        $recup_all = recup_questions($db); 
        return $recup_all;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function recup_questions($db) {
    return $db->query('SELECT * FROM Question');
}
?>