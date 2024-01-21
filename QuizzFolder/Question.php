<?php

namespace QuizzFolder;

/**
 * Classe abstraite Question.
 * Représente une question dans un quizz.
 */
abstract class Question {
    /**
     * Le nom de la question.
     * @var string
     */
    public string $name;

    /**
     * Le type de la question.
     * @var string
     */
    public string $type;

    /**
     * Le texte de la question.
     * @var string
     */
    public string $text;

    /**
     * La réponse(s) correcte(s) à la question.
     * @var array
     */
    private array $answer;

    /**
     * Les choix possibles pour la question.
     * @var array
     */
    private array $choices;

    /**
     * Le score attribué à la question.
     * @var int
     */
    public int $score;
    
    /**
     * Constructeur de la classe Question.
     * @param string $name Le nom de la question.
     * @param string $text Le texte de la question.
     * @param array $answer La réponse(s) correcte(s) à la question.
     * @param array $choices Les choix possibles pour la question.
     * @param int $score Le score attribué à la question.
     */
    public function __construct(string $name, string $text, array $answer, array $choices , int $score) {
        $this->name = $name;
        $this->text = $text;
        $this->answer = $answer;
        $this->choices = $choices;
        $this->score= $score;
    }

    /**
     * Retourne la réponse(s) correcte(s) à la question.
     * @return array La réponse(s) correcte(s) à la question.
     */
    public function getAnswer() { return $this->answer; }

    /**
     * Retourne les choix possibles pour la question.
     * @return array Les choix possibles pour la question.
     */
    public function getChoices() { return $this->choices; }

    /**
     * Retourne le score attribué à la question.
     * @return int Le score attribué à la question.
     */
    public function getScore() { return $this->score; }

    /**
     * Retourne le nom de la question.
     * @return string Le nom de la question.
     */
    public function getName() { return $this->name; }

    /**
     * Retourne le type de la question.
     * @return string Le type de la question.
     */
    public function getType() { return $this->type; }

    /**
     * Retourne le texte de la question.
     * @return string Le texte de la question.
     */
    public function getText(): string { return $this->text; }

    /**
     * Définit la réponse(s) correcte(s) à la question.
     * @param array $answers La réponse(s) correcte(s) à la question.
     */
    public function setAnswer(array $answers) { $this->answer = $answers; }

    /**
     * Définit les choix possibles pour la question.
     * @param array $choices Les choix possibles pour la question.
     */
    public function setChoices(array $choices) { $this->choices = $choices; }

    /**
     * Méthode abstraite pour calculer les points de la question.
     * @param mixed $q Le(s) choix de l'utilisateur.
     * @param mixed $v La réponse(s) correcte(s).
     */
    public abstract function calcul_points($q, $v);

    /**
     * Méthode abstraite pour afficher le rendu de la question.
     * @param int $index L'index de la question.
     */
    public abstract function rendu($index);
}

?>