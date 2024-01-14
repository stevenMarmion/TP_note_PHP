<?php

class Reponse {
    private $ID_reponse;
    private $Texte_reponse;
    private $Est_correcte;
    private $ID_question;

    public function __construct($ID_reponse, $Texte_reponse, $Est_correcte, $ID_question) {
        $this->ID_reponse = $ID_reponse;
        $this->Texte_reponse = $Texte_reponse;
        $this->Est_correcte = $Est_correcte;
        $this->ID_question = $ID_question;
    }
    public function getIDReponse() {
        return $this->ID_reponse;
    }
    public function setIDReponse($ID_reponse) {
        $this->ID_reponse = $ID_reponse;
    }
    public function getTexteReponse() {
        return $this->Texte_reponse;
    }

    public function setTexteReponse($Texte_reponse) {
        $this->Texte_reponse = $Texte_reponse;
    }
    public function getEstCorrecte() {
        return $this->Est_correcte;
    }

    public function setEstCorrecte($Est_correcte) {
        $this->Est_correcte = $Est_correcte;
    }
    public function getIDQuestion() {
        return $this->ID_question;
    }

    public function setIDQuestion($ID_question) {
        $this->ID_question = $ID_question;
    }
}

?>
