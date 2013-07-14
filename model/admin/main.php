<?php
function getListSubjects()
{
    if($_SESSION['user'] == 'admin')
    {
        global $bdd;

        $req = $bdd->prepare("SELECT * FROM subject");
        $req->execute();

        $listSubjects = $req->fetchAll();
        return $listSubjects;
    }
    else
    {
        global $bdd;

        $req = $bdd->prepare("SELECT * FROM subject WHERE username = ?");
        $req->execute(array($_SESSION['user']));

        $listSubjects = $req->fetchAll();
        return $listSubjects;
    }
}

function getCountSubjects()
{
    if($_SESSION['user'] == 'admin')
    {
        global $bdd;

        $req = $bdd->prepare("SELECT COUNT(*) AS id FROM subject");
        $req->execute();

        $data = $req->fetch();

        $countSubjects = $data['id'];
        return $countSubjects;
    }
    else
    {
        global $bdd;

        $req = $bdd->prepare("SELECT COUNT(*) AS id FROM subject WHERE username = ?");
        $req->execute(array($_SESSION['user']));

        $data = $req->fetch();

        $countSubjects = $data['id'];
        return $countSubjects;
    }
}

function getListMessages()
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM message WHERE receiver = ? ORDER BY id DESC') or die(mysql_error());
    $req->execute(array($_SESSION['user']));

    $listMessages = $req->fetchAll();
    return $listMessages;
}

function getCountMessages()
{
    global $bdd;

    $req = $bdd->prepare('SELECT COUNT(*) AS id FROM message WHERE receiver = ?') or die(mysql_error());
    $req->execute(array($_SESSION['user']));

    $data = $req->fetch();

    $countMessages = $data['id'];
    return $countMessages;
}

function getPercentScoreSubject($subjectID)
{
    global $bdd;

    $req = $bdd->prepare("SELECT * FROM score WHERE subjectId = ?");
    $req->execute(array($subjectID));

    $numberScore = 0;
    $additionalAverage = 0;

    while($data = $req->fetch())
    {
        $numberScore++;
        $additionalAverage += $data['average'];
    }

    if($additionalAverage > 0)
    {
        $percent = number_format((($additionalAverage/$numberScore)/20)*100, 2);
    }

    return $percent;
}