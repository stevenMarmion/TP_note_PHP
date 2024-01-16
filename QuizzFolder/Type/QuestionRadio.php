<?php

namespace QuizzFolder\Type;

use QuizzFolder\Question;

class QuestionRadio extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices , $score) {
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
    
    public function calcul_points($q, $v) {
        $score_total += $q->getScore();

        if (is_null($v)) return;

        $correct_answers = $q->getAnswer();
        $given_answers = is_array($v) ? $v : array($v);

        if ($correct_answers[0]['Texte_reponse'] == strtolower($given_answers[0])) { 
            // nous pouvons accéder à [0]['Texte_reponse'] car de toute façon c'est une question radio donc une seule réponse possible
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