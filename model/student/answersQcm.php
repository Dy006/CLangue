<?php
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

function calculAverage($score, $totalQuestions)
{
    if($score < 1)
    {
        $average = 0;
    }
    else
    {
        $average = number_format(($score * 20)/$totalQuestions);
    }

    return $average;
}

function getLevel($average)
{
    if($average < 6)
    {
        $level = 'A1';
    }
    elseif($average > 6 && $average < 11)
    {
        $level = 'A2';
    }
    elseif($average > 10 && $average < 16)
    {
        $level = 'B1';
    }
    elseif($average > 15 && $average < 20)
    {
        $level = 'B2';
    }
    else
    {
        $level = 'C1';
    }

    return $level;
}

function getAverageWithScore($homeworkId)
{
    global $bdd;

    $req = $bdd->prepare("SELECT * FROM score WHERE homeworkId = ?");
    $req->execute(array($homeworkId));

    $numberScore = 0;
    $additionalScore = 0;

    while($data = $req->fetch())
    {
        $numberScore++;

        $additionalScore += number_format(($data['score'] * 20)/$data['numberOfQuestions'], 2);
    }

    if(!empty($additionalScore))
    {
        $average = number_format($additionalScore/$numberScore);
    }

    return $average;
}

function getTypeSubject($id)
{
    global $bdd;

    $req = $bdd->prepare("SELECT type FROM subject where id = ?");
    $req->execute(array($id));

    $subject = $req->fetch();

    return $subject['type'];
}

function alreadyDone($id, $subjectId)
{
    global $bdd;

    $req = $bdd->prepare("SELECT COUNT(*) as nb FROM score WHERE username = :username AND subjectId = :subjectId");
    $req->execute(array('username' => $_SESSION['user'], 'subjectId' => $subjectId));

    $rep = $req->fetch();

    $req = $bdd->prepare("SELECT dateEnd FROM homework WHERE id = ?");
    $req->execute(array($id));

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

function addScoreQcm($username, $subjectId, $homeworkId, $type, $numberOfQuestions, $score, $average, $groupName, $etablishing)
{
    global $bdd;
    $req = $bdd->prepare("INSERT INTO score(username, subjectId, homeworkId, type, numberOfQuestions, score, average, groupName, etablishing) VALUE(:username, :subjectId, :homeworkId, :type, :numberOfQuestions, :score, :average, :groupName, :etablishing)");
    $req->execute(array('username' => $username, 'subjectId' => $subjectId, 'homeworkId' => $homeworkId, 'type' => $type, 'numberOfQuestions' => $numberOfQuestions, 'score' => $score, 'average' => $average, 'groupName' => $groupName, 'etablishing' => $etablishing));
}