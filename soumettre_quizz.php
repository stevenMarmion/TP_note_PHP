<?php

require_once __DIR__ . '/BD/ConnexionBD.php';
require_once __DIR__ . '/BD/RequeteBDD.php';

use BD\RequeteBDD;
use BD\ConnexionBD;

$db = new ConnexionBD();
$requete = new RequeteBDD("Quizz");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reponses_donnees = isset($_POST["nom_quizz"]) ? $_POST["nom_quizz"] : ''; // if ; else
    print_r($reponses_donnees);
    $reponses_donnees = isset($_POST["nb_question"]) ? $_POST["nb_question"] : ''; // if ; else
    print_r($reponses_donnees);
}

?>