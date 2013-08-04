<?php
include_once 'model/sql_connect.php';

if($_SESSION['user'] != NULL && $_SESSION['category'] != 'Student')
{
    header('Location: admin.php');
}

if ($_GET['type'] == 'showWork')
{
    if($_GET['homeworkType'] == 'QCM')
    {
        include_once 'controler/student/showQcm.php';
    }
    else
    {
        include_once 'controler/student/showOral.php';
    }
}
elseif($_GET['type'] == 'answersQcm')
{
    include_once 'controler/student/answersQcm.php';
}
elseif($_GET['type'] == 'login')
{
    include_once 'controler/student/login.php';
}
elseif($_GET['type'] == 'profile')
{
    include_once 'controler/student/profile.php';
}
elseif($_GET['type'] == 'faq')
{
    include_once 'controler/student/faq.php';
}
else
{
	 include_once 'controler/student/index.php';
}
