<?php

namespace QuizzFolder\Type;

require_once __DIR__ . '/../../Classes/Form/Type/InputRadio.php';
require_once __DIR__ . '/../../Classes/Form/GeneriqueFormElement.php';

use QuizzFolder\Question;
use Classes\Form\Type\InputRadio;

/**
 * Classe QuestionRadio
 * 
 * Représente une question de type radio dans un quizz.
 */
class QuestionRadio extends Question {
    /**
     * Constructeur de la classe QuestionRadio.
     * 
     * @param string $name Le nom de la question.
     * @param string $text Le texte de la question.
     * @param array $answer Les réponses correctes de la question.
     * @param array $choices Les choix possibles pour la question.
     * @param mixed $score Le score attribué à la question.
     */
    public function __construct(string $name, string $text, array $answer, array $choices , $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    /**
     * Génère le code HTML pour afficher la question de type radio.
     * 
     * @param int $index L'index de la question.
     * @return string Le code HTML de la question de type radio.
     */
    public function question_radio($index, $id_quizz) {
        $html = "<br>";
        $i = 0;
        foreach (parent::getChoices() as $c) {
            $i += 1;
            $question_radio = new InputRadio("q{$index}_{$i}_$id_quizz", "q{$index}_{$id_quizz}", $c['Texte_choix'], "q{$index}_{$i}_$id_quizz", true);
            $render = $question_radio->render();
            $html .= $render;
        }
        return $html;
    }
    
    /**
     * Calcule les points obtenus pour la question en fonction des réponses données.
     * 
     * @param Question $q La question.
     * @param mixed $v Les réponses données.
     * @return array Un tableau contenant le score correct et le score total.
     */
    public function calcul_points($q, $v) {
        $score_total = 0;
        $score_correct = 0;

        $score_total += $q->getScore();

        if (is_null($v)) return [$score_correct, $score_total];

        $correct_answers = $q->getAnswer();
        $given_answers = is_array($v) ? $v : array($v);

        if ($correct_answers[0]['Texte_reponse'] == strtolower($given_answers[0])) { 
            // nous pouvons accéder à [0]['Texte_reponse'] car de toute façon c'est une question radio donc une seule réponse possible
            $score_correct += $q->getScore();
        }

        return [$score_correct, $score_total];
    }

    /**
     * Renvoie le rendu de la question de type radio.
     * 
     * @param int $index L'index de la question.
     * @return string Le rendu de la question de type radio.
     */
    public function rendu($index, $id_quizz) {
        return $this->question_radio($index, $id_quizz);
    }
}

?>