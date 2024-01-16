<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionCheckbox extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices , $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    public function question_checkbox($index) {
        $html = "<br>";
        $i = 0;
        foreach (parent::getChoices() as $c) {
            $i += 1;
            $html .= "<input type='checkbox' name='q$index" . "[]' value='" . $c['Texte_choix'] . "' id='q{$index}_$i'>";
            $html .= "<label for='q{$index}_$i'>" . $c['Texte_choix'] . "</label>";
        }
        return $html;
    }
    
    public function calcul_points($q, $v) {
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