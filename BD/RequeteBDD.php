<?php

namespace BD;

use PDO;

use Exception;

date_default_timezone_set('Europe/Paris');


class RequeteBDD {

    /**
     * Classe RequeteBDD
     * 
     * Cette classe représente une requête pour une base de données.
     * Elle permet de spécifier la table sur laquelle la requête sera exécutée.
     */
    private String $table;

    /**
     * Constructeur de la classe RequeteBDD.
     * 
     * @param string $table Le nom de la table sur laquelle la requête sera exécutée.
     */
    public function __construct(string $table) {
        $this->table = $table;
    }

    /**
     * Définit la table sur laquelle la requête sera exécutée.
     *
     * @param string $table Le nom de la table.
     * @return void
     */
    public function set_table(string $table) {
        $this->table = $table;
    }

    /**
     * Récupère les données de la table spécifiée à partir de la base de données.
     *
     * @param object $db L'objet représentant la connexion à la base de données.
     * @return array|null Les données récupérées de la table spécifiée, ou null en cas d'erreur.
     */
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

    /**
     * Récupère tous les choix depuis la base de données.
     *
     * @param object $db L'objet représentant la connexion à la base de données.
     * @return object Le résultat de la requête SQL pour récupérer tous les choix.
     */
    function recup_choix($db) {
        return $db->query('SELECT * FROM Choix');
    }

    /**
     * Récupère toutes les questions de la base de données.
     *
     * @param object $db L'objet représentant la connexion à la base de données.
     * @return object Le résultat de la requête SQL pour récupérer toutes les questions.
     */
    function recup_questions($db) {
        return $db->query("SELECT * FROM Question");
    }

    /**
     * Récupère tous les quizz de la base de données.
     *
     * @param PDO $db L'objet de connexion à la base de données.
     * @return PDOStatement La requête SQL pour récupérer tous les quizz.
     */
    function recup_quizz($db) {
        return $db->query('SELECT * FROM Quizz');
    }

    /**
     * Récupère toutes les réponses de la base de données.
     *
     * @param PDO $db L'objet de connexion à la base de données.
     * @return PDOStatement La requête SQL pour récupérer toutes les réponses.
     */
    function recup_reponses($db) {
        return $db->query('SELECT * FROM Reponse');
    }

    /**
     * Récupère les réponses d'une question spécifique dans la base de données.
     *
     * @param object $db L'objet représentant la connexion à la base de données.
     * @param int $id_question L'identifiant de la question.
     * @return object Le résultat de la requête SQL contenant les réponses.
     */
    function recup_reponses_by_id_question($db, $id_question) {
        return $db->query("SELECT Texte_reponse FROM Reponse where ID_question = " . $id_question . "");
    }

    /**
     * Récupère les choix par ID de question dans la base de données.
     *
     * @param object $db L'objet de connexion à la base de données.
     * @param int $id_question L'ID de la question.
     * @return object Le résultat de la requête SQL contenant les choix.
     */
    function recup_choices_by_id_question($db, $id_question) {
        return $db->query("SELECT Texte_choix, Value_choix FROM Choix where ID_question = " . $id_question . "");
    }

    /**
     * Récupère l'identifiant de la dernière question dans la base de données.
     *
     * @param object $db L'objet représentant la connexion à la base de données.
     * @return object Le résultat de la requête SQL pour récupérer l'identifiant de la dernière question.
     */
    function recup_last_id_question($db) {
        return $db->query("SELECT MAX(ID_question) FROM Question");
    }

    /**
     * Récupère l'identifiant du dernier quizz enregistré dans la base de données.
     *
     * @param object $db L'objet représentant la connexion à la base de données.
     * @return mixed L'identifiant du dernier quizz, ou NULL si aucun quizz n'est enregistré.
     */
    function recup_last_id_quizz($db) {
        return $db->query("SELECT MAX(id_quizz) FROM Quizz");
    }

    /**
     * Récupère l'identifiant de la dernière réponse dans la table Reponse.
     *
     * @param PDO $db L'objet de connexion à la base de données.
     * @return PDOStatement|false L'objet PDOStatement contenant le résultat de la requête ou false en cas d'erreur.
     */
    function recup_last_id_reponse($db) {
        return $db->query("SELECT MAX(ID_reponse) FROM Reponse");
    }

    /**
     * Récupère les questions d'un quizz par son ID.
     *
     * @param object $db L'objet de connexion à la base de données.
     * @param int $id_quizz L'ID du quizz.
     * @return object Le résultat de la requête SQL pour récupérer les questions du quizz.
     */
    function recup_questions_by_id_quizz($db, $id_quizz) {
        return $db->query("SELECT * FROM Question where ID_quizz = '" . $id_quizz . "'");
    }

    /**
     * Insère un nouveau quizz dans la base de données.
     *
     * @param PDO $db La connexion à la base de données.
     * @param string $nom_quizz Le nom du quizz à insérer.
     * @return int L'identifiant du dernier quizz inséré.
     */
    function inserer_quizz($db, $nom_quizz) {
        $insert_quizz = "INSERT INTO Quizz (name_quizz) VALUES (:name_quizz)";
        $stmt = $db->prepare($insert_quizz);
        $stmt->bindParam(':name_quizz', $nom_quizz);
        $stmt->execute();
        return $this->recup_last_id_quizz($db);
    }

    /**
     * Insère une question dans la base de données.
     *
     * @param PDO $db La connexion à la base de données.
     * @param string $texteQuestion Le texte de la question à insérer.
     * @param int $idQuizz L'identifiant du quizz auquel la question appartient.
     * @return int L'identifiant de la question insérée.
     */
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

    /**
     * Insère une réponse dans la base de données.
     *
     * @param PDO $db La connexion à la base de données.
     * @param string $texteReponse Le texte de la réponse.
     * @param int $idQuestion L'identifiant de la question associée à la réponse.
     * @return int L'identifiant de la réponse insérée.
     */
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