<?php

namespace BD;

use Exception;

date_default_timezone_set('Europe/Paris');

class RequeteBDD {

    private String $table;
    public function __construct(string $table) {
        $this->table = $table;
    }

    public function set_table(string $table) {
        $this->table = $table;
    }

    function recup_datas($db) {
        try {
            if ($this->table == "Choix") {
                $recup_all = $this->recup_choix($db); 
            }
            else if ($this->table == "Reponse") {
                $recup_all = $this->recup_reponses($db); 
            }
            else if ($this->table == "Question") {
                $recup_all = $this->recup_questions($db); 
            }
            else if ($this->table == "Quizz") {
                $recup_all = $this->recup_quizz($db); 
            }
            return $recup_all;
        } catch (Exception $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            return null;
        }
    }

    function recup_choix($db) {
        return $db->query('SELECT * FROM Choix');
    }

    function recup_questions($db) {
        return $db->query('SELECT * FROM Question');
    }

    function recup_quizz($db) {
        return $db->query('SELECT * FROM Quizz');
    }

    function recup_reponses($db) {
        return $db->query('SELECT * FROM Reponse');
    }

    function recup_reponses_by_id_question($db, $id_question) {
        return $db->query("SELECT Texte_reponse FROM Reponse where ID_question = " . $id_question . "");
    }

    function recup_choices_by_id_question($db, $id_question) {
        return $db->query("SELECT Texte_choix, Value_choix FROM Choix where ID_question = " . $id_question . "");
    }
}

?>