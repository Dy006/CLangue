<?php
function getListGroupsOfTeacher()
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM usergroup WHERE username = :username AND etablishing = :etablishing') or die(mysql_error());
    $req->execute(array('username' => $_SESSION['user'], 'etablishing' => $_SESSION['etablishing']));

    $listGroups = $req->fetchAll();
    return $listGroups;
}

function getNumberOfStudentsGroup($name)
{
    global $bdd;

    $req = $bdd->prepare('SELECT numberOfStudents FROM groups WHERE name = ?') or die(mysql_error());
    $req->execute(array($name));

    $data = $req->fetch();

    $numberOfStudents = $data['numberOfStudents'];
    return $numberOfStudents;
}

function getAverageGroup($name)
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM score WHERE groupName = ? AND type = "QCM"') or die(mysql_error());
    $req->execute(array($name));

    $i = 0;
    $additionalAverage = 0;

    while($data = $req->fetch())
    {
        $i++;
        $additionalAverage += $data['average'];
    }

    if($i > 0)
    {
        $averageGroup = number_format($additionalAverage/$i);
    }

    return $averageGroup;
}

function getInfoScore($subjectId)
{
    global $bdd;

    $req = $bdd->prepare("SELECT * FROM score WHERE subjectId = ?");
    $req->execute(array($subjectId));

    $infoScore = $req->fetchAll();
    return $infoScore;
}