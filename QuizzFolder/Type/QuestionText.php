<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionText extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices , int $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }
    public function question_text() {
        echo "<label>";
        echo ($this->getText() . "<br><input type='text' name='" . $this->getName() . "'><br>");
        echo "</label>";
    }
    
    function answer_text($q, $v) {
        global $question_correct, $score_total, $score_correct;
        $score_total += $q["score"];
        if (is_null($v)) return;
        if ($q["answer"] == $v) {
            $question_correct += 1;
            $score_correct += $q["score"];
        }
    }

    public function rendu() {
        return $this->question_text();
    }
}

?>