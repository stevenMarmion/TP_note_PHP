<?php

namespace QuizzFolder\Type;

require_once __DIR__ . '/../../Classes/Form/Type/InputCheckbox.php';
require_once __DIR__ . '/../../Classes/Form/GeneriqueFormElement.php';

use QuizzFolder\Question;
use Classes\Form\Type\InputCheckbox;

/**
 * Classe QuestionCheckbox représente une question à choix multiple avec cases à cocher.
 */
class QuestionCheckbox extends Question {
    /**
     * Constructeur de la classe QuestionCheckbox.
     *
     * @param string $name Le nom de la question.
     * @param string $text Le texte de la question.
     * @param array $answer Les réponses correctes de la question.
     * @param array $choices Les choix possibles de la question.
     * @param mixed $score Le score de la question.
     */
    public function __construct(string $name, string $text, array $answer, array $choices , $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    /**
     * Génère le code HTML pour afficher la question à choix multiple avec cases à cocher.
     *
     * @param int $index L'index de la question.
     * @return string Le code HTML de la question.
     */
    public function question_checkbox($index) {
        $html = "<br>";
        $i = 0;
        foreach (parent::getChoices() as $c) {
            $i += 1;
            $question_checkbox = new InputCheckbox("q{$index}_$i", "q$index", $c['Texte_choix'], "q{$index}_$i", true);
            $render = $question_checkbox->render();
            $html .= $render;
        }
        return $html;
    }
    
    /**
     * Calcule les points obtenus pour la question en fonction des réponses données.
     *
     * @param Question $q La question.
     * @param mixed $v Les réponses données.
     * @return array Le nombre de points corrects et le nombre de points total.
     */
    public function calcul_points($q, $v) {
        $score_total = 0;
        $score_correct = 0;

        $score_total += $q->getScore();

        if (is_null($v)) return [$score_correct, $score_total];

        $correct_answers = $q->getAnswer();
        $given_answers = is_array($v) ? $v : array($v);

        foreach ($given_answers as $index => $answer) {
            foreach ($correct_answers as $key => $value) {
                if ($correct_answers[$key]['Texte_reponse'] == strtolower($answer)) {
                    $score_correct += $q->getScore() / sizeof($correct_answers);
                }
            }
        }

        return [$score_correct, $score_total];
    }

    /**
     * Renvoie le rendu de la question à choix multiple avec cases à cocher.
     *
     * @param int $index L'index de la question.
     * @return string Le rendu de la question.
     */
    public function rendu($index) {
        return $this->question_checkbox($index);
    }
}

?>