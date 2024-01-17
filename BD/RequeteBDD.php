<?php

namespace BD;

use PDO;

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
        return $db->query("SELECT * FROM Question");
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

    function recup_last_id_question($db) {
        return $db->query("SELECT MAX(ID_question) FROM Question");
    }

    function recup_last_id_quizz($db) {
        return $db->query("SELECT MAX(id_quizz) FROM Quizz");
    }

    function recup_last_id_reponse($db) {
        return $db->query("SELECT MAX(ID_reponse) FROM Reponse");
    }

    function recup_questions_by_id_quizz($db, $id_quizz) {
        return $db->query("SELECT * FROM Question where ID_quizz = '" . $id_quizz . "'");
    }

    function inserer_quizz($db, $nom_quizz) {
        $insert_quizz = "INSERT INTO Quizz (name_quizz) VALUES (:name_quizz)";
        $stmt = $db->prepare($insert_quizz);
        $stmt->bindParam(':name_quizz', $nom_quizz);
        $stmt->execute();
        return $this->recup_last_id_quizz($db);

    }

    function insererQuestion($db, $texteQuestion, $idQuizz) {
        $insert_question = "INSERT INTO Question (ID_question, Nom_question, Type_question, Texte_question, Points_gagnes, ID_quizz) 
                  VALUES (:id_question, 'question_ajoute', 'text', :texte_question, 1, :id_quizz)";
        $stmt = $db->prepare($insert_question);
        $last_id = $this->recup_last_id_question($db)->fetchAll(PDO::FETCH_ASSOC);
        $last_id = $last_id[0]['MAX(ID_question)'] +1;
        $stmt->bindParam(':id_question', $last_id); 
        $stmt->bindParam(':texte_question', $texteQuestion);
        $stmt->bindParam(':id_quizz', $idQuizz);
        $stmt->execute();
        return $last_id;
    }

    function insererReponse($db, $texteReponse, $idQuestion) {
        $insert_rep = "INSERT INTO Reponse (Texte_reponse, Est_correcte, ID_question) 
                  VALUES (:texte_reponse, 'true', :id_question)";
        $last_id = $this->recup_last_id_reponse($db)->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $db->prepare($insert_rep);
        $stmt->bindParam(':texte_reponse', $texteReponse);
        $stmt->bindParam(':id_question', $idQuestion);
        $stmt->execute();
        return $last_id[0]['MAX(ID_reponse)'];
    }
}

?>