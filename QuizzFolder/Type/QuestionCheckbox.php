<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionCheckbox extends Question {
    public function __construct(string $name, string $type, string $text, $answer, int $score) {
        parent::__construct($name, $type, $text, $answer, $score);
    }

    function question_checkbox($q) {
        $html = $q["text"] . "<br>";
        $i = 0;
        foreach ($q["choices"] as $c) {
            $i += 1;
            $html .= "<input type='checkbox' name='$q[name][]' value='$c[value]' id='$q[name]-$i'>";
            $html .= "<label for='$q[name]-$i'>$c[text]</label>";
        }
        echo $html;
    }
    
    function answer_checkbox($q, $v) {
        global $question_correct, $score_total, $score_correct;
        $score_total += $q["score"];
        if (is_null($v)) return;
        $diff1 = array_diff($q["answer"], $v);
        $diff2 = array_diff($v, $q["answer"]);
        if (count($diff1) == 0 && count($diff2) == 0) {
            $question_correct += 1;
            $score_correct += $q["score"];
        }
    }

    public function rendu(Question $question) {
        return $this->question_checkbox($question);
    }
}

?>