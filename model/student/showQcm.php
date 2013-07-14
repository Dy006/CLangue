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

function getQuestionsForSubject($subjectId)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM questions WHERE subjectId = ?');
    $req->execute(array($subjectId));

    $listQuestions = $req->fetchAll();
    return $listQuestions;
}

function getAnswersForQuestion($questionId)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM responses WHERE questionId = ?');
    $req->execute(array($questionId));

    $listAnswers = $req->fetchAll();
    return $listAnswers;
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
	$ancTime = strtotime($rep2['dateEnd']);

	if ($rep['nb'] == 0)
    {
		if ($today > $ancTime)
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