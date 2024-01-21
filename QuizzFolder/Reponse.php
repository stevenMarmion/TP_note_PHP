<?php

/**
 * Cette classe représente une réponse à une question dans un quizz.
 */
class Reponse {
    private $ID_reponse;
    private $Texte_reponse;
    private $Est_correcte;
    private $ID_question;

    /**
     * Constructeur de la classe Reponse.
     *
     * @param int $ID_reponse L'identifiant de la réponse.
     * @param string $Texte_reponse Le texte de la réponse.
     * @param bool $Est_correcte Indique si la réponse est correcte ou non.
     * @param int $ID_question L'identifiant de la question à laquelle la réponse est associée.
     */
    public function __construct($ID_reponse, $Texte_reponse, $Est_correcte, $ID_question) {
        $this->ID_reponse = $ID_reponse;
        $this->Texte_reponse = $Texte_reponse;
        $this->Est_correcte = $Est_correcte;
        $this->ID_question = $ID_question;
    }

    /**
     * Obtient l'identifiant de la réponse.
     *
     * @return int L'identifiant de la réponse.
     */
    public function getIDReponse() {
        return $this->ID_reponse;
    }

    /**
     * Définit l'identifiant de la réponse.
     *
     * @param int $ID_reponse L'identifiant de la réponse.
     */
    public function setIDReponse($ID_reponse) {
        $this->ID_reponse = $ID_reponse;
    }

    /**
     * Obtient le texte de la réponse.
     *
     * @return string Le texte de la réponse.
     */
    public function getTexteReponse() {
        return $this->Texte_reponse;
    }

    /**
     * Définit le texte de la réponse.
     *
     * @param string $Texte_reponse Le texte de la réponse.
     */
    public function setTexteReponse($Texte_reponse) {
        $this->Texte_reponse = $Texte_reponse;
    }

    /**
     * Indique si la réponse est correcte ou non.
     *
     * @return bool Vrai si la réponse est correcte, faux sinon.
     */
    public function getEstCorrecte() {
        return $this->Est_correcte;
    }

    /**
     * Définit si la réponse est correcte ou non.
     *
     * @param bool $Est_correcte Indique si la réponse est correcte ou non.
     */
    public function setEstCorrecte($Est_correcte) {
        $this->Est_correcte = $Est_correcte;
    }

    /**
     * Obtient l'identifiant de la question à laquelle la réponse est associée.
     *
     * @return int L'identifiant de la question.
     */
    public function getIDQuestion() {
        return $this->ID_question;
    }

    /**
     * Définit l'identifiant de la question à laquelle la réponse est associée.
     *
     * @param int $ID_question L'identifiant de la question.
     */
    public function setIDQuestion($ID_question) {
        $this->ID_question = $ID_question;
    }
}
?>
