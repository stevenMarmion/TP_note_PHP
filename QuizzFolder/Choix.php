<?php

namespace QuizzFolder;

class Choix {

    private int $id_choix;
    private string $text;
    private string $value;
    private int $id_question;

    public function __construct(int $id_choix, string $text, string $value, int $id_question) {
        $this->id_choix = $id_choix;
        $this->text = $text;
        $this->value = $value;
        $this->id_question = $id_question;
    }

    public function getIdchoix(): int {
        return $this->id_choix;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getValue(): string {
        return $this->value;
    }

    public function getIdQuestion(): int {
        return $this->id_question;
    }
}

?>