<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
</head>
<body>

<?php

require_once "PDO/requete_quizz.php";
require_once "PDO/requete_question.php";
require_once "PDO/requete_reponse.php";
require_once "PDO/requete_choix.php";

require_once './QuizzFolder/Question.php';
require_once './QuizzFolder/Type/QuestionText.php';
require_once './QuizzFolder/Type/QuestionRadio.php';
require_once './QuizzFolder/Type/QuestionCheckbox.php';

use QuizzFolder\Type\QuestionText;
use QuizzFolder\Type\QuestionRadio;
use QuizzFolder\Type\QuestionCheckbox;

$liste_quizz = recup_datas_quizz();
$liste_questions = recup_datas_questions();
$liste_reponses = recup_datas_reponses();
$liste_choix = recup_datas_choix();

function construit_responses($liste_questions) {
    $liste_questions_a_afficher = [];

    foreach ($liste_questions as $question) {
        if ($question['Type_question'] == 'texte') {
            $current_question = new QuestionText($question['Nom_question'], 
                                                 $question['Texte_question'], 
                                                 [],
                                                 [], 
                                                 $question['Points_gagnes']
            );
            $liste_questions_a_afficher[] = $current_question;
        }
        else if ($question['Type_question'] == 'radio') {
            $current_question = new QuestionRadio($question['Nom_question'], 
                                                 $question['Texte_question'], 
                                                 [],
                                                 [], 
                                                 $question['Points_gagnes']
            );
            $liste_questions_a_afficher[] = $current_question;
        }
        else if ($question['Type_question'] == 'texte') {
            $current_question = new QuestionCheckbox($question['Nom_question'], 
                                                 $question['Texte_question'], 
                                                 [],
                                                 [], 
                                                 $question['Points_gagnes']
            );
            $liste_questions_a_afficher[] = $current_question;
        }
    }

    return $liste_questions_a_afficher;
}

$liste_reponses = construit_responses($liste_questions);

// Vérification des réponses postées
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;

    foreach ($quizz as $index => $question) {
        $userAnswer = isset($_POST["q$index"]) ? $_POST["q$index"] : '';

        if ($userAnswer === $question['reponse_correcte']) {
            $score++;
        }
    }

    echo "<h2>Votre score est de $score / " . count($quizz) . "</h2>";
}

?>

<form method="post" action="index.php">

    <?php foreach ($liste_quizz as $quizz): ?>
        <h3><?= $quizz ?></h3>
    <?php endforeach; ?>

    <?php foreach ($liste_questions as $question): ?>
        <?= $reponse->rendu() ?>
    <?php endforeach; ?>
    <br>

    <br>
    <input type="submit" value="Soumettre vos réponses">

</form>

</body>
</html>
