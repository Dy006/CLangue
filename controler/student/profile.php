<?php
include_once 'model/student/profile.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] == 'Student')
{
    if($_GET['a'] == 'deco')
    {
        session_destroy();

        header('Location: index');
    }
    elseif ($_GET['a'] == 'changePassword' && isset($_POST['password2']) && isset($_POST['password1']))
    {
        $resultChangePassword = changePassword($_POST['password1'], $_POST['password2']);
    }

    include_once 'view/student/profile.php';
}
else
{
    header('Location: login');
}