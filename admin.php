<?php
include_once 'model/sql_connect.php';

if ($_SESSION['user'] != NULL)
{
    if($_GET['type'] == 'addwork')
    {
        include_once 'controler/admin/addWork.php';
    }
    elseif($_GET['type']  == 'work')
    {
        include_once 'controler/admin/work.php';
    }
    elseif($_GET['type'] == 'editwork')
    {
        include_once 'controler/admin/editWork.php';
    }
    elseif($_GET['type'] == 'group')
    {
        include_once 'controler/admin/group.php';
    }
    elseif($_GET['type'] == 'resultgroup')
    {
        include_once 'controler/admin/resultGroup.php';
    }
    elseif($_GET['type'] == 'message')
    {
        include_once 'controler/admin/message.php';
    }
    elseif ($_GET['type']  == 'profile')
    {
        include_once 'controler/admin/profile.php';
    }
    elseif($_GET['type'] == 'admin')
    {
        include_once 'controler/admin/admin.php';
    }
    else
    {
        include_once 'controler/admin/dashboard.php';
    }
}
else
{
    include_once 'controler/admin/index.php';
}