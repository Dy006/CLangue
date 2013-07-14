<?php
function getListGroupsOfTeacher()
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM usergroup WHERE username = :username AND etablishing = :etablishing') or die(mysql_error());
    $req->execute(array('username' => $_SESSION['user'], 'etablishing' => $_SESSION['etablishing']));

    $listGroups = $req->fetchAll();
    return $listGroups;
}

function getListUsersGroup($groupName)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM usergroup WHERE groupName = ? AND category = "Student"');
    $req->execute(array($groupName));

    $listUsers = $req->fetchAll();
    return $listUsers;
}

function getListHomeworks()
{
    global $bdd;
    $req = $bdd->prepare('SELECT * FROM homework WHERE username = ? ORDER BY id DESC') or die(mysql_error());
    $req->execute(array($_SESSION['user']));

    $listHomeworks = $req->fetchAll();
    return $listHomeworks;
}

function getNameWithTypeSubject($id)
{
    global $bdd;
    $req = $bdd->prepare('SELECT name, type FROM subject WHERE id = ?') or die(mysql_error());
    $req->execute(array($id));

    $data = $req->fetch();

    $nameWithType = $data['name'] . ' - ' . $data['type'];
    return $nameWithType;
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

function getNumberUsersScore($homeworkId, $groupName)
{
    $numberOfStudents = getNumberOfStudentsGroup($groupName);

    global $bdd;
    $req = $bdd->prepare('SELECT COUNT(*) AS id FROM score WHERE homeworkId = ?') or die(mysql_error());
    $req->execute(array($homeworkId));

    $data = $req->fetch();

    $numberUsersScore = $data['id'];

    $finalValue = $numberUsersScore . '/' . $numberOfStudents;
    return $finalValue;
}

function getInfoSubject($name)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM subject WHERE name = ?');
    $req->execute(array($name));

    $infoSubject = $req->fetch();

    return $infoSubject;
}

function addHomework($name, $work, $groupName, $dateEnd)
{
    $infoSubject = getInfoSubject($work);

    global $bdd;

    foreach($groupName as $group)
    {
        $req = $bdd->prepare('INSERT INTO homework(username, name, type, subjectId, groupName, dateEnd) VALUE (:username, :name, :type, :subjectId, :groupName, :dateEnd)');
        $req->execute(array('username' => $_SESSION['user'], 'name' => $name, 'type' => $infoSubject['type'], 'subjectId' => $infoSubject['id'], 'groupName' => $group, 'dateEnd' => $dateEnd));
    }
}

function deleteHomework($id)
{
    global $bdd;

    $req = $bdd->prepare('DELETE FROM homework WHERE id = ?');
    $req->execute(array($id));

    $req = $bdd->prepare('DELETE FROM score WHERE homeworkId = ?');
    $req->execute(array($id));
}