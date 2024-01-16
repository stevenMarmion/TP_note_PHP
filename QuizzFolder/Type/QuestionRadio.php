<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionRadio extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices , int $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    public function question_radio($index) {
        $html = "<br>";
        $i = 0;
        foreach (parent::getChoices() as $c) {
            $i += 1;
            $html .= "<input type='radio' name='q$index' value='" . $c['Texte_choix'] . "' id='q{$index}_$i'>";
            $html .= "<label for='q{$index}_$i'>" . $c['Texte_choix'] . "</label>";
        }
        return $html;
    }
    
    function calcul_points($q, $v) {
        global $question_correct, $score_total, $score_correct;
        $score_total += $q->getScore();
        if (is_null($v)) return;
        if ($q->getAnswer() == $v) {
            $question_correct += 1;
            $score_correct += $q->getScore();
        }
        return [$score_correct, $score_total];
    }

    public function rendu($index) {
        return $this->question_radio($index);
    }
}

?>