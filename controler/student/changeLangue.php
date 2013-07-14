<?php
session_start();

if($_GET['l'] != NULL)
{
    if($_GET['l'] == 'spanish')
    {
        $_SESSION['language'] = 'es';
    }
    elseif($_GET['l'] == 'italian')
    {
        $_SESSION['language'] = 'it';
    }
    elseif($_GET['l'] == 'deutsh')
    {
        $_SESSION['language'] = 'al';
    }
    elseif ($_GET['l'] == 'french')
    {
        $_SESSION['language'] = 'fr';
    }
    elseif ($_GET['l'] == 'english')
    {
        $_SESSION['language'] = 'en';
    }
    else
    {
        $_SESSION['language'] = 'en';
    }
}
header('Location: ../');