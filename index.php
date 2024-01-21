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
require_once __DIR__ . '/BD/RequeteBDD.php';

use BD\RequeteBDD;
use BD\ConnexionBD;

// Création de l'objet de connexion à la base de données
$db = new ConnexionBD();

// Récupération des données des quizz depuis la base de données
$requete = new RequeteBDD("Quizz");
$res_quizz = $requete->recup_datas($db::obtenir_connexion());
$liste_quizz = $res_quizz->fetchAll(PDO::FETCH_ASSOC);

?>

<form action="main_quizz.php" method="post">
    <h3>Choix du quizz</h3>
    <select name="quizz" id="quizz">
        <?php
        foreach ($liste_quizz as $index_quizz => $quizz) {
            ?> 
                <option value="<?=$index_quizz+1?>">Quizz <?= $index_quizz+1 ?></option> 
            <?php
        }
        ?>
    </select>
    <input type="submit" value="Démarrer">
</form>

<?php

// Formulaire de création de quizz
?>
<form method="post" action="creation_quizz.php">
    <input type="hidden" name="redirection" value="false">
    <h3>Créer votre propre quizz dès maintenant</h3>
    <input class="form_creation_quizz" type="submit" value="Créer un quizz">
</form>

</body>
</html>

