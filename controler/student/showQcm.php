<?php
include_once 'model/student/showQcm.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] == 'Student')
{
    $subjectId = $_GET['subjectId'];
    $homeworkId = $_GET['homeworkId'];

    $subject = getSubject($subjectId);
    $listQuestions = getQuestionsForSubject($subjectId);
    $done = alreadyDone($subjectId, $homeworkId);

    if($subject[5] == 1)
    {
        if($done != false)
        {
            if($subject[4] == 'QCM')
            {
                include_once 'view/student/showQcm.php';
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
