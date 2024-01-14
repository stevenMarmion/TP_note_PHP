<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionRadio extends Question {
    public function __construct(string $name, string $type, string $text, array $answer, array $choices , int $score) {
        parent::__construct($name, $type, $text, $answer, $choices, $score);
    }

    function question_radio($q) {
        $html = $q["text"] . "<br>";
        $i = 0;
        foreach ($q["choices"] as $c) {
            $i += 1;
            $html .= "<input type='radio' name='$q[name]' value='$c[value]' id='$q[name]-$i'>";
            $html .= "<label for='$q[name]-$i'>$c[text]</label>";
        }
        echo $html;
    }
    
    function answer_radio($q, $v) {
        global $question_correct, $score_total, $score_correct;
        $score_total += $q["score"];
        if (is_null($v)) return;
        if ($q["answer"] == $v) {
            $question_correct += 1;
            $score_correct += $q["score"];
        }
    }

    public function rendu(Question $question) {
        return $this->question_radio($question);
    }
}

?>