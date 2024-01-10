<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionText extends Question {
    public function __construct(string $name, string $type, string $text, $answer, int $score) {
        parent::__construct($name, $type, $text, $answer, $score);
    }
    function question_text(Question $q) {
        echo ($q->getText() . "<br><input type='text' name='" . $q->getName() . "'><br>");
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

    public function rendu(Question $question) {
        return $this->question_text($question);
    }
}

?>