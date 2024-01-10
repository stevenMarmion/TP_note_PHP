<?php
use QuizzFolder\Type\QuestionCheckbox;
use QuizzFolder\Type\QuestionRadio;
use QuizzFolder\Type\QuestionText;

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

?>