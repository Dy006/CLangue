<?php
/**
 * Created by JetBrains PhpStorm.
 * User: guillaume
 * Date: 17/06/13
 * Time: 11:04
 * To change this template use File | Settings | File Templates.
 */

include_once "model/student/answersQcm.php";

if($_SESSION['user'] != NULL && $_SESSION['category'] == 'Student')
{
    if($_GET['homeworkId'] != NULL && $_GET['subjectId'] != NULL)
    {
        $subjectId = $_GET['subjectId'];
        $homeworkId = $_GET['homeworkId'];

        $type = getTypeSubject($subjectId);
        $groupName = getGroupNameHomework($homeworkId);

        if($type != NULL)
        {
            $done = alreadyDone($homeworkId, $subjectId);

            if($done != false)
            {
                if($type == 'QCM')
                {
                    $score = 0;
                    $numberOfQuestions = 0;
                    $number = 0;

                    $listQuestions = getQuestionsForSubject($subjectId);

                    include_once "view/student/answersQcm.php";

                    addScoreQcm($_SESSION['user'], $subjectId, $homeworkId, $type, $numberOfQuestions, $score, $average, $groupName, $_SESSION['etablishing']);
                }
                else
                {
                    include_once 'view/student/error.php';
                }
            }
            else
            {
                include_once 'view/student/error.php';
            }
        }
        else
        {
            include_once 'view/student/error.php';
        }
    }
    else
    {
        include_once 'view/student/error.php';
    }
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}


