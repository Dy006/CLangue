<?php
function getInfoSubject($id)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM subject WHERE id = ?') or die(mysql_error());
    $req->execute(array($id));

    $infoSubject = $req->fetchAll();
    return $infoSubject;
}

function getInfoScore($homeworkId)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM score WHERE homeworkId = ?') or die(mysql_error());
    $req->execute(array($homeworkId));

    $infoScore = $req->fetchAll();
    return $infoScore;
}