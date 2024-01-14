<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionRadio extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices , int $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    function question_radio() {
        $html = $this->text . "<br>";
        $i = 0;
        foreach ($this->choices as $c) {
            $i += 1;
            $html .= "<input type='radio' name='$this->name' value='$c[value]' id='$this->name-$i'>";
            $html .= "<label for='$this->name-$i'>$c[text]</label>";
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

    public function rendu() {
        return $this->question_radio();
    }
}

?>