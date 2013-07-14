<?php
include_once 'model/admin/index.php';

if(isset($_POST['password']))
{
    $resultLogin = connectionAdmin($_POST['username'], $_POST['password'], $_POST['etablishing']);
}

$listEtablishings = getListEtablishings();

include_once "view/admin/index.php";