<?php
function getListHomework($groupName)
{
    global $bdd;

    $query = 'SELECT * FROM homework WHERE groupName = "' . $groupName[0] . '"';

    $countTab = count($groupName);

    for($i = 1; $i < $countTab; $i++)
    {
        $query .= ' OR groupName = "' . $groupName[$i] . '"';
    }

    $query .= ' ORDER BY id DESC';

    $req = $bdd->prepare($query) or die(mysql_error());
    $req->execute();

    $listHomeworks = $req->fetchAll();

    return $listHomeworks;
}

function getInfoScoreUser($homeworkId)
{
    global $bdd;

    $req = $bdd->prepare('SELECT COUNT(*) AS id FROM score WHERE username = :username AND homeworkId = :homeworkId') or die(mysql_error());
    $req->execute(array('username' => $_SESSION['user'], 'homeworkId' => $homeworkId));

    $infoScoreUser = $req->fetch();

    if($infoScoreUser['id'] > 0)
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getDispSubject($subjectId)
{
    global $bdd;

    $req = $bdd->prepare('SELECT disp FROM subject WHERE id = ?') or die(mysql_error());
    $req->execute(array($subjectId));

    $dispSubject = $req->fetch();

    if($dispSubject['disp'] == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
}