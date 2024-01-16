<?php

require_once __DIR__ . '/BD/ConnexionBD.php';
require_once __DIR__ . '/QuizzFolder/Question.php';
require_once __DIR__ . '/QuizzFolder/Type/QuestionText.php';
require_once __DIR__ . '/QuizzFolder/Type/QuestionRadio.php';
require_once __DIR__ . '/QuizzFolder/Type/QuestionCheckbox.php';
require_once __DIR__ . '/BD/RequeteBDD.php';
require_once __DIR__ . '/verifie_reponse.php';

use QuizzFolder\Type\QuestionText;
use QuizzFolder\Type\QuestionRadio;
use QuizzFolder\Type\QuestionCheckbox;
use BD\RequeteBDD;
use BD\ConnexionBD;

$db = new ConnexionBD();

$requete = new RequeteBDD("Question");
$liste_questions = $requete->recup_datas($db::obtenir_connexion())->fetchAll(PDO::FETCH_ASSOC);

$requete->set_table("Reponse");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du Quizz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .quiz-result {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .score {
            font-size: 24px;
            font-weight: bold;
            color: #28a745; /* couleur verte */
        }
    </style>
</head>
<body>

<div class="quiz-result">
    <h2>Résultat du Quizz</h2>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $score = 0;
            $score_total = 0;
            foreach ($liste_questions as $index => $question_data) {
                $bonne_rep = $requete->recup_reponses_by_id_question($db::obtenir_connexion(), $question_data['ID_question'])->fetchAll(PDO::FETCH_ASSOC);
                $reponses_donnees = isset($_POST["q$index"]) ? $_POST["q$index"] : '';
        
                if ($question_data['Type_question'] == 'text') {
                    $question_text = new QuestionText(
                        $question_data['Nom_question'],
                        $question_data['Texte_question'],
                        array($reponses_donnees),
                        array(),
                        $question_data['Points_gagnes'] != null ? $question_data['Points_gagnes'] : 0
                    );
                    $res_text = $question_text->calcul_points($question_text, $bonne_rep[0]['Texte_reponse']);
                    $score += $res_text[0];
                    $score_total += $res_text[1];
                }
                else if ($question_data['Type_question'] == 'radio') {
                    $liste_choices = $requete->recup_choices_by_id_question($db::obtenir_connexion(), $question_data['ID_question'])->fetchAll(PDO::FETCH_ASSOC);
                    $question_radio = new QuestionRadio(
                        $question_data['Nom_question'],
                        $question_data['Texte_question'],
                        $bonne_rep,
                        $liste_choices,
                        $question_data['Points_gagnes'] != null ? $question_data['Points_gagnes'] : 0
                    );
                    $res_radio = $question_radio->calcul_points($question_radio, $reponses_donnees);
                    $score += $res_radio[0];
                    $score_total += $res_radio[1];
                }
        
                else if ($question_data['Type_question'] == 'checkbox') {
                    $liste_choices = $requete->recup_choices_by_id_question($db::obtenir_connexion(), $question_data['ID_question'])->fetchAll(PDO::FETCH_ASSOC);
                    $question_checkbox = new QuestionCheckbox(
                        $question_data['Nom_question'],
                        $question_data['Texte_question'],
                        $bonne_rep,
                        $liste_choices,
                        $question_data['Points_gagnes'] != null ? $question_data['Points_gagnes'] : 0
                    );
                    $res_checkbox = $question_checkbox->calcul_points($question_checkbox, $reponses_donnees);
                    $score += $res_checkbox[0];
                    $score_total += $res_checkbox[1];
                }
            }
            echo "<h2>Votre score est de $score / $score_total</h2>";
        }
    ?>
</div>

</body>
</html>