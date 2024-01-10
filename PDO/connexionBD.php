<?php

date_default_timezone_set('Europe/Paris');

try {
    $db = new PDO('sqlite:quizz.sqlite3');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db->exec("CREATE TABLE IF NOT EXISTS Question (
        idQuestion INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        type TEXT,
        text TEXT,
        answer TEXT,
        score INTEGER
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS Quizz (
        idQuizz INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS Choices (
        idQuestionChoices INTEGER,
        idQuizzCHoices INTEGER,
        textChoice TEXT,
        FOREIGN KEY(idQuestionChoices) REFERENCES Question(idQuestion),
        FOREIGN KEY (idQUizzChoices) REFERENCES Quizz(idQuizz),
        CONSTRAINT pk_choices primary key (idQuestionChoices, idQuizzChoices)
    )");
    
    $questions = [
        array(
            "name" => "ultime",
            "type" => "text",
            "text" => "Quelle est la réponse ultime ? ",
            "answer" => "42",
            "score" => 1
        ),
        array(
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
            //"answer" => ["bleu", "blanc", "rouge"],
            "answer" => "blanc",
            "score" => 3
        ),
    ];

    $insertQuizz = "INSERT INTO Quizz (title) VALUES ('Le quizz délirant !')";
    $stmt = $db->prepare($insertQuizz);
    $stmt->execute();

    $insertQuestions = "INSERT INTO Question (name, type, text, answer, score) VALUES (:name, :type, :text, :answer, :score)";
    
    $stmt = $db->prepare($insertQuestions);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':text', $text);
    $stmt->bindParam(':answer', $answer);
    $stmt->bindParam(':score', $score);

    foreach ($questions as $question) {
        $name = $question['name'];
        $type = $question['type'];
        $text = $question['text'];
        $answer = $question['answer'];
        $score = $question['score'];
        echo $name . " " . $type . " " . $text . " " . $answer . " " . $score;
        echo "\n";
        $stmt->execute();
    }

    echo "Insertion réussie !";

    // $recup_all = $db->query('SELECT * FROM contacts');
    // foreach ($recup_all as $data) {
    //     echo "\n";
    //     echo $data['id'] . " " . $data['nom'] . " " . $data['prenom'] . " " . $data['time'];
    // }
    // echo "\n";

    //$delete_all = $db->query('DELETE FROM contacts');

    $db = null;
    // ferme la connexion à la base de données

    // $db->exec("INSERT INTO contacts (nom, prenom, time) VALUES ('Marmion', 'Steven', ".time().")");
    // $db->exec("INSERT INTO contacts (nom, prenom, time) VALUES ('Depont', 'Samuel', ".time().")");

    // $insert = $db->query('SELECT * FROM contacts');
    // print_r($insert->fetchAll());
    // $delete = $db->query('DELETE FROM contacts');
    
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?>