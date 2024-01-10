<?php

date_default_timezone_set('Europe/Paris');

try {
    $db = new PDO('sqlite:contacts.sqlite3');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    echo "<h1>Ma liste de personne </h1>";
    $recup_detail = $db->query('SELECT * FROM contacts where id = ' . $_GET['ID']);
    $pers = $recup_detail->fetchObject();

    echo $pers->nom . " " . $pers->prenom . " " . date('d/m/Y H:i:s', $pers->time); 
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>