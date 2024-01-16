<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

require_once __DIR__ . '/BD/ConnexionBD.php';
require_once __DIR__ . '/QuizzFolder/Question.php';
require_once __DIR__ . '/QuizzFolder/Type/QuestionText.php';
require_once __DIR__ . '/QuizzFolder/Type/QuestionRadio.php';
require_once __DIR__ . '/QuizzFolder/Type/QuestionCheckbox.php';
require_once __DIR__ . '/BD/RequeteBDD.php';

use QuizzFolder\Type\QuestionText;
use QuizzFolder\Type\QuestionRadio;
use QuizzFolder\Type\QuestionCheckbox;
use BD\RequeteBDD;
use BD\ConnexionBD;

$db = new ConnexionBD();

$requete = new RequeteBDD("Quizz");
$res_quizz = $requete->recup_datas($db::obtenir_connexion());
$liste_quizz = $res_quizz->fetchAll(PDO::FETCH_ASSOC);

$requete->set_table("Question");
$res_question = $requete->recup_datas($db::obtenir_connexion());
$liste_questions = $res_question->fetchAll(PDO::FETCH_ASSOC);

$requete->set_table("Choix");
$res_choix = $requete->recup_datas($db::obtenir_connexion());
$liste_choix = $res_choix->fetchAll(PDO::FETCH_ASSOC);

$requete->set_table("Reponse");
$res_reponse = $requete->recup_datas($db::obtenir_connexion());
$liste_reponses = $res_reponse->fetchAll(PDO::FETCH_ASSOC);

function construit_responses($liste_questions, $requete, $db) {
    $liste_questions_a_afficher = [];

    foreach ($liste_questions as $question) {

        $responses = $requete->recup_reponses_by_id_question($db::obtenir_connexion(), $question['ID_question']);
        $liste_reponses = $responses->fetchAll(PDO::FETCH_ASSOC);

        $choices = $requete->recup_choices_by_id_question($db::obtenir_connexion(), $question['ID_question']);
        $liste_choices = $choices->fetchAll(PDO::FETCH_ASSOC);

        if ($question['Type_question'] == 'text') {
            $current_question = new QuestionText($question['Nom_question'], 
                                                 $question['Texte_question'], 
                                                 $liste_reponses,
                                                 [], 
                                                 $question['Points_gagnes']
            );
            $liste_questions_a_afficher[] = $current_question;
        }
        else if ($question['Type_question'] == 'radio') {
            $current_question = new QuestionRadio($question['Nom_question'], 
                                                 $question['Texte_question'], 
                                                 $liste_reponses,
                                                 $liste_choices, 
                                                 $question['Points_gagnes']
            );
            $liste_questions_a_afficher[] = $current_question;
        }
        else if ($question['Type_question'] == 'checkbox') {
            $current_question = new QuestionCheckbox($question['Nom_question'], 
                                                 $question['Texte_question'], 
                                                 $liste_reponses,
                                                 $liste_choices, 
                                                 $question['Points_gagnes']
            );
            $liste_questions_a_afficher[] = $current_question;
        }
    }

    return $liste_questions_a_afficher;
}

$liste_questions_a_afficher = construit_responses($liste_questions, $requete, $db);

?>

<form method="post" action="verifie_reponse.php">

    <?php foreach ($liste_quizz as $quizz): ?>
        <h3><?= $quizz['name_quizz'] ?></h3>
    <?php endforeach; ?>

    <?php foreach ($liste_questions_a_afficher as $index => $question): ?>
        <div class="question-container">
            <h4><?= $question->getText() ?></h4>
            <?= $question->rendu($index) ?>
        </div>
    <?php endforeach; ?>
    <br>

    <br>
    <input type="submit" value="Soumettre vos réponses">

</form>

<form method="post" action="creation_quizz.php">
    <input type="hidden" name="redirection" value="false">
    <h3>Créer votre propre quizz dès maintenant</h3>
    <input class="form_creation_quizz" type="submit" value="Créer un quizz">
</form>

</body>
</html>
