<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionText extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices, int $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }
    public function question_text($index) {
        echo ("<br><input type='text' name='q$index' id='q{$index}'><br>");
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
        return $this->question_text($index);
    }
}

?>