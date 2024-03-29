<?php

/**
 * Ce fichier PHP est responsable de la soumission d'un quizz.
 * Il récupère les informations du quizz à partir des paramètres GET,
 * insère les données dans la base de données à l'aide de la classe RequeteBDD,
 * puis affiche un message de remerciement à l'utilisateur.
 * Enfin, il propose un bouton pour revenir à la page d'accueil.
 */

$nb_question = isset($_GET['nb_question']) ? (int)$_GET['nb_question'] : 0;
$nom_quizz = isset($_GET['nom_quizz']) ? $_GET['nom_quizz'] : '';

require_once __DIR__ . '/BD/ConnexionBD.php';
require_once __DIR__ . '/BD/RequeteBDD.php';

use BD\RequeteBDD;
use BD\ConnexionBD;

$db = new ConnexionBD();
$requete = new RequeteBDD("Quizz");

$id_quizz = $requete->inserer_quizz($db::obtenir_connexion(), $nom_quizz);
$id_quizz = $id_quizz->fetchAll(PDO::FETCH_ASSOC); // 2

for ($i = 0; $i < $nb_question; $i++) {
    $nom_question = isset($_POST["nom_question_$i"]) ? $_POST["nom_question_$i"] : '';
    $rep_question = isset($_POST["rep_question_$i"]) ? $_POST["rep_question_$i"] : '';
    $id_question = $requete->insererQuestion($db::obtenir_connexion(), $nom_question, $id_quizz[0]['MAX(id_quizz)']);
    $id_rep = $requete->insererReponse($db::obtenir_connexion(), $rep_question, $id_question);
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
    <form name="x" action="index.php" method="post">
    <input type="submit" value="Revenir à la page d'accueil">
    </form>
</body>
</html>
