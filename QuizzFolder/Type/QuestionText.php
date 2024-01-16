<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionText extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices, $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }
    public function question_text($index) {
        echo ("<br><input type='text' name='q$index' id='q{$index}'><br>");
    }
    
    function calcul_points($q, $v) {
        $score_total += $q->getScore(); // 1

        if (is_null($v)) return 0;
        
        if ($q->getAnswer()[0] == $v) { // if 42 == 42
            $question_correct += 1;
            $score_correct += $q->getScore(); // 1
        }

        return [$score_correct, $score_total];
    }

    public function rendu($index) {
        return $this->question_text($index);
    }
}

?>