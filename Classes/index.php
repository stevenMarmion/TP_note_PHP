<?php

// require_once "InputCheckbox.php";
// require_once "InputHidden.php";
// require_once "InputNumber.php";
// require_once "InputText.php";

namespace Classes;

\AutoLoader::register();

use Classes\Form\Type\InputCheckbox;
use Classes\Form\Type\InputNumber;
use Classes\Form\Type\InputText;

$input = new InputText("1", "INPUT TEXT", "rentrez du texte", "un texte", true);
$inputCheckbox = new InputCheckbox("1", "INPUT TEXT", "rentrez du texte", "un texte", true);
$inputNumber = new InputNumber("1", "INPUT TEXT", "rentrez du texte", "un texte", true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de création d'un input</title>
</head>
<body>
    <?php
        $input->render();
        $inputCheckbox->render();
        $inputNumber->render();
    ?>
</body>
</html>