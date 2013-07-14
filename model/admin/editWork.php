<?php
function getSubject($id)
{
    global $bdd;
    
    $req = $bdd->prepare('SELECT * FROM subject WHERE id = ?');
    $req->execute(array($id));
    
    $infoSubject = $req->fetch();
    
    $infoArray = array($infoSubject['id'], $infoSubject['username'], $infoSubject['name'], $infoSubject['enonce'], $infoSubject['type']);
    return $infoArray;
}

function getQuestionsForSubject($subjectId)
{
    global $bdd;
    
    $req = $bdd->prepare('SELECT * FROM questions WHERE subjectId = ?');
    $req->execute(array($subjectId));
    
    $infoQuestion = $req->fetchAll();
    return $infoQuestion;
}

function getAnswersForQuestion($questionId)
{
    global $bdd;
    
    $req = $bdd->prepare('SELECT * FROM responses WHERE questionId = ?');
    $req->execute(array($questionId));
    
    $infoAnswer = $req->fetchAll();
    return $infoAnswer;
}

function saveEditSubject($enonce, $id)
{
    global $bdd;

    $req = $bdd->prepare('UPDATE subject SET enonce = :enonce WHERE id = :id');
    $req->execute(array('enonce' => $enonce, 'id' => $id));
}

function deleteQuestionsAndAnswers($id)
{
    global $bdd;

    $req2 = $bdd->prepare("SELECT id FROM questions WHERE subjectId = ?");
    $req2->execute(array($id));

    $infoId = $req2->fetchAll();

    $req3 = $bdd->prepare("DELETE FROM questions WHERE subjectId = ?");
    $req3->execute(array($id));

    foreach ($infoId as $info)
    {
        $questionId = $info['id'];

        $req4 = $bdd->prepare("DELETE FROM responses WHERE questionId = ?");
        $req4->execute(array($questionId));
    }
}