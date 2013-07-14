<?php
function showSubject($id)
{
    global $bdd;

    $req = $bdd->prepare('UPDATE subject SET disp = "1" WHERE id = ?');
    $req->execute(array($id));
}

function hideSubject($id)
{
    global $bdd;

    $req = $bdd->prepare('UPDATE subject SET disp = "0" WHERE id = ?');
    $req->execute(array($id));
}

function getTypeSubject($id)
{
    global $bdd;
    
    $req = $bdd->prepare('SELECT type FROM subject WHERE id = ?');
    $req->execute(array($id));

    $infoSubject = $req->fetch();

    $typeSubject = $infoSubject['type'];
    return $typeSubject;
}

function deleteSubject($id)
{
    $typeSubject = getTypeSubject($id);

    global $bdd;

    $req = $bdd->prepare("DELETE FROM subject WHERE id = ?");
    $req->execute(array($id));

    $req2 = $bdd->prepare("SELECT id FROM questions WHERE sujet_id = ?");
    $req2->execute(array($id));

    $infos = $req2->fetch();

    $ids = $infos['id'];

    $req3 = $bdd->prepare("DELETE  FROM questions WHERE sujet_id = ?");
    $req3->execute(array($id));

    $req4 = $bdd->prepare("DELETE  FROM responses WHERE questionID = ?");
    $req4->execute(array($ids));

    return $typeSubject;
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