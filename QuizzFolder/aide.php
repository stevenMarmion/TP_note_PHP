<?php

namespace QuizzFolder;

use QuizzFolder\Type\QuestionCheckbox;
use QuizzFolder\Type\QuestionRadio;
use QuizzFolder\Type\QuestionText;

?>


<!doctype html>
<html>
    <head>
    <title>Quizz</title>
    </head>
    <body>

<?php
$questions = [
    array(
        "name" => "ultime",
        "type" => "text",
        "text" => "Quelle est la réponse ultime?",
        "answer" => "42",
        "score" => 1
    ),
    array(
        "name" => "cheval",
        "type" => "radio",
        "text" => "Quelle est la couleur du cheval blanc d'Henri IV?",
        "choices" => [
            array(
                "text" => "Bleu",
                "value" => "bleu"),
            array(
                "text" => "Blanc",
                "value" => "blanc"),
            array(
                "text" => "Rouge",
                "value" => "rouge"),
        ],
        "answer" => "blanc",
        "score" => 2
    ),
    array(
        "name" => "drapeau",
        "type" => "checkbox",
        "text" => "Quelles sont les couleurs du drapeau français?",
        "choices" => [
            array(
                "text" => "Bleu",
                "value" => "bleu"
            ),
            array(
                "text" => "Blanc",
                "value" => "blanc"
            ),
            array(
                "text" => "Vert",
                "value" => "vert"
            ),
            array(
                "text" => "Jaune",
                "value" => "jaune"
            ),
            array(
                "text" => "Rouge",
                "value" => "rouge"
            )
        ],
        "answer" => ["bleu", "blanc", "rouge"],
        "score" => 3
    ),
];

foreach ($questions as $question) {
    if ($question["type"] == "text") {
        $questionText = new QuestionText($question["text"], $question["type"], $question["text"], $question["answer"], $question["score"]);
    }
    else if ($question["type"] == "radio") {
        $questionRadio = new QuestionRadio($question["text"], $question["type"], $question["text"], $question["answer"], $question["score"]);
    }
    else if ($question["type"] == "checkbox") {
        $questionCheckbox = new QuestionCheckbox($question["text"], $question["type"], $question["text"], $question["answer"], $question["score"]);
    }
}

echo "". $questionText ."";
echo "". $questionRadio ."";
echo "". $questionCheckbox ."";

$question_handlers = array(
    "text" => "question_text",
    "radio" => "question_radio",
    "checkbox" => "question_checkbox"
);

$answer_handlers = array(
    "text" => "answer_text",
    "radio" => "answer_radio",
    "checkbox" => "answer_checkbox"
);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<form method='POST' action='quiz.php'><ol>";
    foreach ($questions as $q) {
        echo "<li>";
        $question_handlers[$q["type"]]($q);
    }
    echo "</ol><input type='submit' value='Envoyer'></form>";
} else {
    $question_total = 0;
    $question_correct = 0;
    $score_total = 0;
    $score_correct = 0;
    foreach ($questions as $q) {
        $question_total += 1;
        $answer_handlers[$q["type"]]($q, $_POST[$q["name"]] ?? NULL);
    }
    echo "Réponses correctes: " . $question_correct . "/" . $question_total . "<br>";
    echo "Votre score: " . $score_correct . "/" . $score_total . "<br>";
}
phpinfo(INFO_VARIABLES);

?>
    </body>
</html>

