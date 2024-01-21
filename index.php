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

/**
 * Fichier principal de l'application Quizz.
 * Ce fichier contient le code HTML et PHP nécessaire pour afficher les quizz et gérer les réponses.
 * Il inclut les fichiers de classes nécessaires et utilise des requêtes SQL pour récupérer les données des quizz et des questions.
 * Les réponses des utilisateurs sont soumises via un formulaire et traitées dans le fichier "verifie_reponse.php".
 * Il y a également un formulaire pour créer un nouveau quizz dans le fichier "creation_quizz.php".
 */

// Inclusion des fichiers de classes et de la connexion à la base de données
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

// Création de l'objet de connexion à la base de données
$db = new ConnexionBD();

// Récupération des données des quizz depuis la base de données
$requete = new RequeteBDD("Quizz");
$res_quizz = $requete->recup_datas($db::obtenir_connexion());
$liste_quizz = $res_quizz->fetchAll(PDO::FETCH_ASSOC);

// Récupération des données des questions depuis la base de données
$requete->set_table("Question");
$res_question = $requete->recup_datas($db::obtenir_connexion());
$liste_questions = $res_question->fetchAll(PDO::FETCH_ASSOC);

/**
 * Fonction pour construire les objets Question à afficher pour un quizz donné.
 * @param array $liste_questions Liste des questions à afficher.
 * @param RequeteBDD $requete Objet RequeteBDD pour effectuer les requêtes SQL.
 * @param ConnexionBD $db Objet ConnexionBD pour la connexion à la base de données.
 * @param int $id_quizz ID du quizz pour lequel construire les questions.
 * @return array Liste des objets Question à afficher.
 */
function construit_responses($liste_questions, $requete, $db, $id_quizz) {
    $liste_questions_a_afficher = [];
    $res_question = $requete->recup_questions_by_id_quizz($db::obtenir_connexion(), $id_quizz);
    $liste_questions = $res_question->fetchAll(PDO::FETCH_ASSOC);

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

// Affichage des quizz et des questions
foreach ($liste_quizz as $index_quizz => $quizz) {
    $liste_questions_a_afficher = construit_responses($liste_questions, $requete, $db, $index_quizz+1);
    ?>
        <form method="post" action="verifie_reponse.php">
            <h3><?= $quizz['name_quizz'] ?></h3>
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
    <?php
}

// Formulaire de création de quizz
?>
<form method="post" action="creation_quizz.php">
    <input type="hidden" name="redirection" value="false">
    <h3>Créer votre propre quizz dès maintenant</h3>
    <input class="form_creation_quizz" type="submit" value="Créer un quizz">
</form>

</body>
</html>

