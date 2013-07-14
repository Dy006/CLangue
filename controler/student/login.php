<?php 
include_once 'model/student/login.php';

if($_SESSION['user'] != NULL)
{
    header('Location: index');
}
elseif(isset($_POST['password']))
{
    $resultLogin = connectionStudent($_POST['username'], $_POST['password'], $_POST['etablishing']);
}

$listEtablishings = getListEtablishings();

include_once "view/student/login.php";