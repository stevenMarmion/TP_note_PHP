<?php

namespace QuizzFolder\Type;

require_once __DIR__ . '/../../Classes/Form/Type/InputCheckbox.php';
require_once __DIR__ . '/../../Classes/Form/GeneriqueFormElement.php';

use QuizzFolder\Question;
use Classes\Form\Type\InputCheckbox;

class QuestionCheckbox extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices , $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    public function question_checkbox($index) {
        $html = "<br>";
        $i = 0;
        foreach (parent::getChoices() as $c) {
            $i += 1;
            $question_checkbox = new InputCheckbox("q{$index}_$i", "q$index", $c['Texte_choix'], "q{$index}_$i", true);
            $render = $question_checkbox->render();
            $html .= $render;
        }
        return $html;
    }
    
    public function calcul_points($q, $v) {
        $score_total = 0;
        $score_correct = 0;

        $score_total += $q->getScore();

        if (is_null($v)) return 0;

        $correct_answers = $q->getAnswer();
        $given_answers = is_array($v) ? $v : array($v);

        foreach ($given_answers as $index => $answer) {
            foreach ($correct_answers as $key => $value) {
                if ($correct_answers[$key]['Texte_reponse'] == strtolower($answer)) {
                    $score_correct += $q->getScore() / sizeof($correct_answers);
                }
            }
        }

        return [$score_correct, $score_total];
    }

    public function rendu($index) {
        return $this->question_checkbox($index);
    }
}

?>