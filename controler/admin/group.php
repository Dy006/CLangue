<?php
include_once 'model/admin/main.php';
include_once 'model/admin/group.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    if($_GET['a'] == 'deleteHomework' && $_GET['id'] != NULL && is_numeric($_GET['id']))
    {
        deleteHomework($_GET['id']);
    }
    elseif($_GET['a'] == 'addHomework')
    {
        addHomework($_POST['name'], $_POST['work'], $_POST['selectGroupName'], $_POST['dateEnd']);
    }

    $listSubjects = getListSubjects();
    $countSubjects = getCountSubjects();

    $listMessages = getListMessages();
    $countMessages = getCountMessages();

    $listHomeworks = getListHomeworks();

    $listGroups = getListGroupsOfTeacher();

    include_once 'view/admin/group.php';
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}