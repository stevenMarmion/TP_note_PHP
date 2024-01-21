<?php

namespace QuizzFolder;

use QuizzFolder\Question;

/**
 * Classe représentant un quizz.
 */
class Quizz {
    /**
     * Liste des questions du quizz.
     * @var []
     */
    public $questions;

    /**
     * Titre du quizz.
     * @var string
     */
    public string $titreQuizz;

    /**
     * Constructeur de la classe Quizz.
     * @param [] $questions Liste des questions du quizz.
     * @param string $titre Titre du quizz.
     */
    public function __construct($questions, string $titre) {
        $this->questions = $questions;
        $this->titreQuizz = $titre;
    }

    /**
     * Retourne la liste des questions du quizz.
     * @return [] Liste des questions du quizz.
     */
    public function getQuestions() {
        return $this->questions;
    }

    /**
     * Ajoute une question au quizz.
     * @param Question $question La question à ajouter.
     */
    public function ajouteQuestion(Question $question) {
        $this->questions->add($question);
    }
}

?>