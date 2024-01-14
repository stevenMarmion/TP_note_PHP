<?php

namespace QuizzFolder;

abstract class Question {
    public $name;
    public $type;
    public $text;
    private $answer;

    private $choices; // liste de choix
    
    public $score;
    
    public function __construct(string $name, string $type, string $text, array $answer, array $choices , int $score) {
        $this->$name = $name;
        $this->$type = $type;
        $this->$text = $text;
        $this->$answer = $answer;
        $this->choices = $choices;
        $this->$score= $score;
    }

    public function getAnswer() { return $this->answer; }

    public function getChoices() { return $this->choices; }

    public function getScore() { return $this->score; }

    public function getName() { return $this->name; }

    public function getType() { return $this->type; }

    public function getText(): string { return $this->text; }

    public abstract function rendu();
}

?>