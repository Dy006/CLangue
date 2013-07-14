<?php
include_once 'model/admin/main.php';
include_once 'model/admin/message.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    if($_GET['a'] == 'addMessage')
    {
        addMessage($_POST['selectReceiver'], $_POST['object'], $_POST['body']);
    }
    elseif($_GET['a'] == 'replyMessage')
    {
        replyMessage($_POST['id'], $_POST['receiver'], $_POST['object'], $_POST['body']);
    }

	$listSubjects = getListSubjects();
    $countSubjects = getCountSubjects();

    $listMessages = getListMessages();
    $countMessages = getCountMessages();

    $listTeachers = getListTeachers();

    if($_GET['id'] != NULL)
    {
        $message = getMessage($_GET['id']);
    }

    include_once 'view/admin/message.php';
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}