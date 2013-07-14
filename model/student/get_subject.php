<?php
/**
 * Created by JetBrains PhpStorm.
 * User: guillaume
 * Date: 15/06/13
 * Time: 19:53
 * To change this template use File | Settings | File Templates.
*/

function getSubject($id)
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM subject WHERE id=:id");
    $req->execute(array('id'=> $id));
    $info_subject = $req->fetch();
    $info_array = array($info_subject['id'],$info_subject['name'], $info_subject['enonce'], $info_subject['disp'], $info_subject['date']);
    return $info_array;
}
function getQuestionForSubject($subjectID)
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM questions WHERE subjectId=:id");
    $req->execute(array('id'=> $subjectID));
    $info_question = $req->fetchAll();
    return $info_question;
}
function getReponsesForQuestion($questionID)
{
    global $bdd;
    $req = $bdd->prepare("SELECT * FROM responses WHERE questionId=:id");
    $req->execute(array('id'=> $questionID));
    $info_reponse = $req->fetchAll();
    return $info_reponse;
}
function addScore($username, $numberOfQuestions, $score, $sujetID)
{
    global $bdd;
    $req = $bdd->prepare("INSERT INTO score(id,username, sujet_id, NumberQuestion, score) VALUE('',:username, :SuID, :numbers,:score )");
    $req->execute(array('username' => $username, 'SuID' => $sujetID, 'numbers' => $numberOfQuestions, 'score' => $score));
}
function alreadyDone($ids)
{
	global $bdd;
	$req = $bdd->prepare("SELECT COUNT(*) as nb FROM score WHERE username = :user AND subjectId = :ids");
	$req->execute(array('user'=>$_SESSION['user'], 'ids'=>$ids));
	$rep = $req->fetch();
	$today = time();
	$ancTime = strtotime($rep['dateEnd']);
	if ($rep['nb'] != 0 && $ancTime<$today) 
	{
		return false;
	}
	else
	{
		return true;
	}	
	
}