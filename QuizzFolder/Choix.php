<?php

namespace QuizzFolder;

/**
 * La classe Choix représente une option de réponse dans un quiz.
 */
class Choix {

    private int $id_choix;
    private string $text;
    private string $value;
    private int $id_question;

    /**
     * Constructeur de la classe Choix.
     *
     * @param int $id_choix L'identifiant de l'option de réponse.
     * @param string $text Le texte de l'option de réponse.
     * @param string $value La valeur de l'option de réponse.
     * @param int $id_question L'identifiant de la question associée à l'option de réponse.
     */
    public function __construct(int $id_choix, string $text, string $value, int $id_question) {
        $this->id_choix = $id_choix;
        $this->text = $text;
        $this->value = $value;
        $this->id_question = $id_question;
    }

    /**
     * Obtient l'identifiant de l'option de réponse.
     *
     * @return int L'identifiant de l'option de réponse.
     */
    public function getIdchoix(): int {
        return $this->id_choix;
    }

    /**
     * Obtient le texte de l'option de réponse.
     *
     * @return string Le texte de l'option de réponse.
     */
    public function getText(): string {
        return $this->text;
    }

    /**
     * Obtient la valeur de l'option de réponse.
     *
     * @return string La valeur de l'option de réponse.
     */
    public function getValue(): string {
        return $this->value;
    }

    /**
     * Obtient l'identifiant de la question associée à l'option de réponse.
     *
     * @return int L'identifiant de la question associée à l'option de réponse.
     */
    public function getIdQuestion(): int {
        return $this->id_question;
    }
}

?>