<?php

require_once __DIR__ . '/BD/ConnexionBD.php';
// require_once __DIR__ . '/QuizzFolder/Question.php';
// require_once __DIR__ . '/QuizzFolder/Type/QuestionText.php';
// require_once __DIR__ . '/QuizzFolder/Type/QuestionRadio.php';
// require_once __DIR__ . '/QuizzFolder/Type/QuestionCheckbox.php';
require_once __DIR__ . '/BD/RequeteBDD.php';

// use QuizzFolder\Type\QuestionText;
// use QuizzFolder\Type\QuestionRadio;
// use QuizzFolder\Type\QuestionCheckbox;
use BD\RequeteBDD;
use BD\ConnexionBD;

$db = new ConnexionBD();

$requete = new RequeteBDD("Question");
$liste_questions = $requete->recup_datas($db::obtenir_connexion())->fetchAll(PDO::FETCH_ASSOC);

$requete->set_table("Reponse");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;

    foreach ($liste_questions as $index => $question) {
        $reponses_donnees = isset($_POST["q$index"]) ? $_POST["q$index"] : ''; // if ; else
        print_r($reponses_donnees);
        //$score += $question->calcul_points($question, $reponses_donnees);
    }
    echo "<h2>Votre score est de $score</h2>";
}

?>