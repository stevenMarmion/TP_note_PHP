<?php
$nb_question = isset($_GET['nb_question']) ? (int)$_GET['nb_question'] : 0;
$nom_quizz = isset($_GET['nom_quizz']) ? $_GET['nom_quizz'] : '';

require_once __DIR__ . '/BD/ConnexionBD.php';
require_once __DIR__ . '/BD/RequeteBDD.php';

use BD\RequeteBDD;
use BD\ConnexionBD;

$db = new ConnexionBD();
$requete = new RequeteBDD("Quizz");

$id_quizz = $requete->inserer_quizz($db::obtenir_connexion(), $nom_quizz);

for ($i = 0; $i < $nb_question; $i++) {
    $nom_question = isset($_POST["nom_question_$i"]) ? $_POST["nom_question_$i"] : '';
    $rep_question = isset($_POST["rep_question_$i"]) ? $_POST["rep_question_$i"] : '';
    echo "Question n°" . ($i + 1) . ": Nom = $nom_question, Réponse = $rep_question<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soumettre votre quizz</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Merci d'avoir soumis votre quizz!</h1>
</body>
</html>
