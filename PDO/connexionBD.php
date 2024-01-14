<?php

date_default_timezone_set('Europe/Paris');

try {
    $questions = create_questions();

    $db = init_DB();
    create_tables($db);
    make_insert_quizz($db);
    make_insert_questions($db, $questions);
    make_insert_reponse($db, $questions);
    make_insert_choix($db, $questions);

    echo "Insertion réussie !";
    $db = null;
    
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

function init_DB() {
    $cheminFichierSQLite = __DIR__ . '/../quizz.sqlite3';
    $db = new PDO('sqlite:' . $cheminFichierSQLite);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo PHP_EOL . 'Connexion réussie' . PHP_EOL;   
    return $db;
}

function create_tables($db) {
    $db->exec("CREATE TABLE IF NOT EXISTS Quizz (
        id_quizz INTEGER PRIMARY KEY AUTOINCREMENT,
        name_quizz TEXT
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS Question (
        ID_question INTEGER PRIMARY KEY,
        Nom_question TEXT,
        Type_question TEXT,
        Texte_question TEXT,
        Points_gagnes INTEGER,
        ID_quizz INTEGER,
        FOREIGN KEY (ID_quizz) REFERENCES Quizz(ID_quizz)
    )");

    $db->exec("CREATE TABLE Reponse (
        ID_reponse INTEGER PRIMARY KEY AUTOINCREMENT,
        Texte_reponse TEXT,
        Est_correcte BOOLEAN,
        ID_question INTEGER,
        FOREIGN KEY (ID_question) REFERENCES Question(ID_question)
    )");

    $db->exec("CREATE TABLE Choix (
        ID_choix INTEGER PRIMARY KEY AUTOINCREMENT,
        Texte_choix TEXT,
        ID_question INTEGER,
        FOREIGN KEY (ID_question) REFERENCES Question(ID_question)
    );");
}

function make_insert_quizz($db) {
    $insertQuizz = "INSERT INTO Quizz (name_quizz) VALUES ('Le quizz délirant !')";
    $stmt = $db->prepare($insertQuizz);
    $stmt->execute();
}

function make_insert_questions($db, $questions) {
    $id_question = null;
    $name = null;
    $type = null;
    $text = null;
    $points = null;

    $insertQuestions = "INSERT INTO Question (ID_question, Nom_question, Type_question, Texte_question, Points_gagnes, ID_quizz) VALUES (:id_question, :name, :type, :text, :points, 1)";
    
    $stmt = $db->prepare($insertQuestions);
    $stmt->bindParam(':id_question', $id_question);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':points', $points);

    foreach ($questions as $question) {
        $id_question =$question['id'];
        $name = $question['name'];
        $type = $question['type'];
        $text = $question['text'];
        $points = $question['score'];
        $stmt->execute();
    }
}

function make_insert_reponse($db, $questions) {
    $answer = null;
    $id_question = null;
    $insertReponse = "INSERT INTO Reponse (Texte_reponse, Est_correcte, ID_question) VALUES (:text_res, true, :id_question)";
    
    $stmt = $db->prepare($insertReponse);
    $stmt->bindParam(':text_res', $answer);
    $stmt->bindParam(':id_question', $id_question);

    foreach ($questions as $question) {
        if (is_array($question['answer'])) {
            foreach ($question['answer'] as $current_answer) {
                $answer = $current_answer;
                $id_question = $question['id'];
                $stmt->execute();
            }
        } else {
            $answer = $question['answer'];
            $id_question = $question['id'];
            $stmt->execute();
        }
    }
}

function make_insert_choix($db, $questions) {
    $texte_choix = null;
    $id_question = null;

    $insertReponse = "INSERT INTO Choix (Texte_choix, ID_question) VALUES (:texte_choix, :id_question)";
    
    $stmt = $db->prepare($insertReponse);
    $stmt->bindParam(':texte_choix', $texte_choix);
    $stmt->bindParam(':id_question', $id_question);

    foreach ($questions as $question) {
        if (isset($question['choices'])) {
            foreach ($question['choices'] as $current_choice) {
                $texte_choix = $current_choice['value'];
                $id_question = $question['id'];
                $stmt->execute();
            }
        }
    }
}

function create_questions() {
    $questions = [
        array(
            "id" => 1,
            "name" => "ultime",
            "type" => "text",
            "text" => "Quelle est la réponse ultime ? ",
            "answer" => "42",
            "score" => 1
        ),
        array(
            "id" => 2,
            "name" => "cheval",
            "type" => "radio",
            "text" => "Quelle est la couleur du cheval blanc d'Henri IV ? ",
            "choices" => [
                array(
                    "text" => "Bleu",
                    "value" => "bleu"),
                array(
                    "text" => "Blanc",
                    "value" => "blanc"),
                array(
                    "text" => "Rouge",
                    "value" => "rouge"),
            ],
            "answer" => "blanc",
            "score" => 2
        ),
        array(
            "id" => 3,
            "name" => "drapeau",
            "type" => "checkbox",
            "text" => "Quelles sont les couleurs du drapeau français ? ",
            "choices" => [
                array(
                    "text" => "Bleu",
                    "value" => "bleu"
                ),
                array(
                    "text" => "Blanc",
                    "value" => "blanc"
                ),
                array(
                    "text" => "Vert",
                    "value" => "vert"
                ),
                array(
                    "text" => "Jaune",
                    "value" => "jaune"
                ),
                array(
                    "text" => "Rouge",
                    "value" => "rouge"
                )
            ],
            "answer" => ["bleu", "blanc", "rouge"],
            "score" => 3
        ),
    ];
    return $questions;
}

?>