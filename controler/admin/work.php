<?php
include_once 'model/admin/main.php';
include_once 'model/admin/work.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    if ($_GET['a'] == 'hideSubject' && $_GET['id'] != NULL && is_numeric($_GET['id']))
    {
        hideSubject($_GET['id']);
    }
    elseif ($_GET['a'] == 'showSubject' && $_GET['id'] != NULL && is_numeric($_GET['id']))
    {
        showSubject($_GET['id']);
    }
    elseif ($_GET['a'] == 'deleteSubject' && $_GET['id'] != NULL && is_numeric($_GET['id']))
    {
        $typeSubject = deleteSubject($_GET['id']);

        if($typeSubject == 'QCM')
        {
            deleteQuestionsAndAnswers($_GET['id']);
        }
    }

    $listSubjects = getListSubjects();
    $countSubjects = getCountSubjects();

    $listMessages = getListMessages();
    $countMessages = getCountMessages();

    include_once 'view/admin/work.php';
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}