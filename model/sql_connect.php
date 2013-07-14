<?php session_start();

try
{
    $bdd = new PDO('mysql:host=mysql2.alwaysdata.com;dbname=loquii_wcl' , 'loquii_english' , 'english');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
