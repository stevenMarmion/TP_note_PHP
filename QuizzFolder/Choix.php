<?php

namespace QuizzFolder;

class Choix {

    private int $id_choix;
    private string $text;
    private int $id_question;

    public function __construct(int $id_choix, string $text, int $id_question) {
        $this->id_choix = $id_choix;
        $this->text = $text;
        $this->id_question = $id_question;
    }

    public function getIdchoix(): int {
        return $this->id_choix;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getIdQuestion(): int {
        return $this->id_question;
    }
}

?>