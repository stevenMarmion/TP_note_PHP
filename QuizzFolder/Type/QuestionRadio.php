<?php

namespace QuizzFolder\Type;

require_once __DIR__ . '/../../Classes/Form/Type/InputRadio.php';
require_once __DIR__ . '/../../Classes/Form/GeneriqueFormElement.php';

use QuizzFolder\Question;
use Classes\Form\Type\InputRadio;

class QuestionRadio extends Question {
    public function __construct(string $name, string $text, array $answer, array $choices , $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    public function question_radio($index) {
        $html = "<br>";
        $i = 0;
        foreach (parent::getChoices() as $c) {
            $i += 1;
            $question_radio = new InputRadio("q{$index}_$i", "q$index", $c['Texte_choix'], "q{$index}_$i", true);
            $render = $question_radio->render();
            $html .= $render;
        }
        return $html;
    }
    
    public function calcul_points($q, $v) {
        $score_total = 0;
        $score_correct = 0;

        $score_total += $q->getScore();

        if (is_null($v)) return;

        $correct_answers = $q->getAnswer();
        $given_answers = is_array($v) ? $v : array($v);

        if ($correct_answers[0]['Texte_reponse'] == strtolower($given_answers[0])) { 
            // nous pouvons accéder à [0]['Texte_reponse'] car de toute façon c'est une question radio donc une seule réponse possible
            $score_correct += $q->getScore();
        }

        return [$score_correct, $score_total];
    }

    public function rendu($index) {
        return $this->question_radio($index);
    }
}

?>