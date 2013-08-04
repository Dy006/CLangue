<?php
function getSubject($id)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM subject WHERE id = ?');
    $req->execute(array($id));

    $infoSubject = $req->fetch();

    $infoArray = array($infoSubject['id'], $infoSubject['username'], $infoSubject['name'], $infoSubject['enonce'], $infoSubject['type'], $infoSubject['disp']);
    return $infoArray;
}

function alreadyDone($subjectId, $homeworkId)
{
    global $bdd;

    $req = $bdd->prepare('SELECT COUNT(*) as nb FROM score WHERE username = :username AND subjectId = :subjectId AND homeworkId = :homeworkId');
    $req->execute(array('username' => $_SESSION['user'], 'subjectId' => $subjectId, 'homeworkId' => $homeworkId));

    $rep = $req->fetch();

	$req = $bdd->prepare('SELECT dateEnd FROM homework WHERE id = ?');
    $req->execute(array($homeworkId));

    $rep2 = $req->fetch();

	$today = time();
    $timestamp = DateTime::createFromFormat('!d/m/Y', $rep2['dateEnd'])->getTimestamp();

	if ($rep['nb'] == 0)
    {
		if ($today > $timestamp)
		{
			return false;
		}
		else
		{
			return true;
		}
    }
    else
    {
        return false;
    }
}

function getGroupNameHomework($id)
{
    global $bdd;

    $req = $bdd->prepare('SELECT groupName FROM homework WHERE id = ?');
    $req->execute(array($id));

    $infoHomework = $req->fetch();

    $groupName = $infoHomework['groupName'];
    return $groupName;
}

function addScoreOral($subjectId, $homeworkId, $type, $time)
{
    $groupName = getGroupNameHomework($homeworkId);

	global $bdd;
	
	$linktemp = 'http://pox.alwaysdata.net/other/tutorials/workclasslangue/userFiles/mp3/record_' . $homeworkId . '_' . $_SESSION['user'] . '.mp3';
	$link = str_replace(' ','', $linktemp);

	$req = $bdd->prepare('INSERT INTO score(username, subjectId, homeworkId, type, link, time, groupName, etablishing) VALUE (:username, :subjectId, :homeworkId, :type, :link, :time, :groupName, :etablishing)');
	$req->execute(array('username' => $_SESSION['user'], 'subjectId' => $subjectId, 'homeworkId'=> $homeworkId, 'type' => $type, 'link' => $link,':time' => $time, 'groupName' =>  $groupName, 'etablishing' =>  $_SESSION['etablishing']));
}