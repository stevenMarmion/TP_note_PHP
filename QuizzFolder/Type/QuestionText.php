<?php

namespace QuizzFolder\Type;

require_once __DIR__ . '/../../Classes/Form/Type/InputText.php';
require_once __DIR__ . '/../../Classes/Form/GeneriqueFormElement.php';

use QuizzFolder\Question;
use Classes\Form\Type\InputText;

/**
 * Classe QuestionText
 * 
 * Cette classe représente une question de type texte dans un quizz.
 * Elle hérite de la classe Question.
 */
class QuestionText extends Question {
    /**
     * Constructeur de la classe QuestionText
     * 
     * @param string $name Le nom de la question
     * @param string $text Le texte de la question
     * @param array $answer Les réponses possibles à la question
     * @param array $choices Les choix possibles pour la question
     * @param mixed $score Le score de la question
     */
    public function __construct(string $name, string $text, array $answer, array $choices, $score) {
        parent::__construct($name, $text, $answer, $choices, $score);
    }

    /**
     * Génère le code HTML pour afficher la question de type texte
     * 
     * @param int $index L'index de la question
     * @return string Le code HTML de la question
     */
    public function question_text($index) {
        $html = "<br>";
        $question_text = new InputText("q{$index}", "q$index", "", "", true);
        $render = $question_text->render();
        $html .= $render;
        $html .= "<br>";
        return $html;
    }
    
    /**
     * Calcule les points obtenus pour la question
     * 
     * @param mixed $q La question
     * @param mixed $v La réponse donnée
     * @return array Un tableau contenant le score correct et le score total
     */
    function calcul_points($q, $v) {
        $score_total = 0;
        $score_correct = 0;

        $score_total += $q->getScore(); // 1

        if (is_null($v)) return 0;
        
        if ($q->getAnswer()[0] == $v) { // if 42 == 42
            $score_correct += $q->getScore(); // 1
        }

        return [$score_correct, $score_total];
    }

    /**
     * Renvoie le rendu de la question
     * 
     * @param int $index L'index de la question
     * @return string Le rendu de la question
     */
    public function rendu($index) {
        return $this->question_text($index);
    }
}

?>