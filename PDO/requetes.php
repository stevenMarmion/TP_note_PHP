<?php

date_default_timezone_set('Europe/Paris');

try {
    $db = new PDO('sqlite:contacts.sqlite3');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    echo "<h1>Ma liste de personne </h1>";
    $recup_all = $db->query('SELECT * FROM contacts');
?>
<form method="GET" action="rechercher.php">
<select name="ID">
<?php
    foreach ($recup_all as $data) {
        echo "<option value=\"" . $data['id'] . "\">" . $data['nom'] . " " . $data['prenom'] . "</option>";
    }

    echo "<input type=\"submit\" value=\"Rechercher\" />";
    echo "</select>";
    echo "</form>";
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>