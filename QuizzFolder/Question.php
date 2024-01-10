<?php

namespace QuizzFolder;

abstract class Question {
    public $name;
    public $type;
    public $text;
    private $answer;
    public $score;
    
    public function __construct(string $name, string $type, string $text, $answer, int $score) {
        $this->$name = $name;
        $this->$type = $type;
        $this->$text = $text;
        $this->$answer = $answer;
        $this->$score= $score;
    }

    public function getAnswer() { return $this->answer; }

    public function getText() { return $this->text; }

    public function getName() { return $this->name; }

    public abstract function rendu();
}

?>