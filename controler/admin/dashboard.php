<?php
include_once 'model/admin/main.php';
include_once 'model/admin/dashboard.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    $listSubjects = getListSubjects();
    $countSubjects = getCountSubjects();

    $listMessages = getListMessages();
    $countMessages = getCountMessages();

    $listGroups = getListGroupsOfTeacher();

    include_once 'view/admin/dashboard.php';
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}