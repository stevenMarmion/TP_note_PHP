<?php

require_once __DIR__ . '/BD/ConnexionBD.php';
require_once __DIR__ . '/BD/RequeteBDD.php';

use BD\RequeteBDD;
use BD\ConnexionBD;

$db = new ConnexionBD();
$requete = new RequeteBDD("Quizz");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de votre quizz</title>
    <link rel="stylesheet" href="style.css">
</head>
    <body>
        <form method="post" action="soumettre_quizz.php">
            <h3>Nom du quizz</h3>
            <input type="text" style="width: 50%;" name="nom_quizz" placeholder="Insérer un nom de quizz">

            <h3>Insérer le nombre de question</h3>
            <input type="text" style="width: 50%;" name="nb_question" placeholder="Combien de questions voulez-vous créer ?">

            <?php if (isset($_POST["nb_question"])) {
                    for ($i=0; $i<$_POST["nb_question"]; $i++) {
                    echo "<h3>Créer les questions associées</h3>";
                    echo "<input type='text' style='width: 50%;' name='nom_question_$i' placeholder='Insérer un nom de question'>";
                }
            }
            ?>
            <br>

            <br>
            <input type="submit" id="refresh" value="Soumettre votre quizz">
            <?php
            if(isset($_GET['refresh'])) {
                    header('Location: ./creation_quizz.php/true');
            }
            ?>
        </form>
    </body>
</html>
