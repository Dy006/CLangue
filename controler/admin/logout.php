<?php session_start();

session_destroy();

setcookie('currentUser', '', time() - 365 * 24 * 3600, null, null, false, true);

header('Location:  /other/tutorials/workclasslangue/');