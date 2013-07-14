<?php
function addSubject($name, $enonce, $type)
{
    global $bdd;

    $req = $bdd->prepare('INSERT INTO subject(username, name, enonce, type, disp) VALUE (:username, :name, :enonce, :type, "1")');
    $req->execute(array('username' => $_SESSION['user'], 'name' => $name, 'enonce' => $enonce, 'type' => $type));

    return $bdd->lastInsertId();
}

function addQuestion($subjectId, $numberQuestion, $text)
{
    global $bdd;

    $req = $bdd->prepare("INSERT INTO questions(subjectId, numberQuestion, text) VALUE(:subjectId, :numberQuestion, :text)");
    $req->execute(array('subjectId' => $subjectId, 'numberQuestion' => $numberQuestion, 'text' => $text));

    return $bdd->lastInsertId();
}

function addAnswer($response, $questionId, $valid)
{
    global $bdd;

    $req = $bdd->prepare("INSERT INTO responses(response, questionId, valid) VALUE(:response, :questionId, :valid)");
    $req->execute(array('response'=> $response, 'questionId' => $questionId, 'valid' => $valid));

    return $bdd->lastInsertId();
}