<?php

namespace QuizzFolder;

use QuizzFolder\Question;

class Quizz {
    public $questions; // liste de Question
    public string $titreQuizz;

    public function __construct($questions, string $titre) {
        $this->questions = $questions;
        $this->titreQuizz = $titre;
    }

    public function getQuestions() {
        return $this->questions;
    }

    public function ajouteQuestion(Question $question) {
        $this->questions->add($question);
    }
}

?>