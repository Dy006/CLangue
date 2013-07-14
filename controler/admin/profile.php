<?php
include_once 'model/admin/main.php';
include_once 'model/admin/profile.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    if ($_GET['a'] == 'changePassword' && isset($_POST['password2']) && isset($_POST['password1']))
    {
        $resultChangePassword = changePassword($_POST['password1'], $_POST['password2']);
    }

    $listSubjects = getListSubjects();
    $countSubjects = getCountSubjects();

    $listMessages = getListMessages();
    $countMessages = getCountMessages();

    $infoUser = getInfoUser();

    include_once 'view/admin/profile.php';
}
else
{
    header("HTTP/1.1 403 Forbidden");

    echo '<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don\'t have permission to access to this resource on this server.</p></body></html>';

    exit();
}