<?php
include_once 'model/student/index.php';

if ($_SESSION['user'] != NULL)
{
    $listHomeworks = getListHomework($_SESSION['groupName']);
}

include_once "view/student/index.php";
