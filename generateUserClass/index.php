<?php
/**
 * Created by JetBrains PhpStorm.
 * User: guillaume
 * Date: 10/07/13
 * Time: 09:40
 * To change this template use File | Settings | File Templates.
 */
session_start();

try
{
    $bdd = new PDO('mysql:host=mysql2.alwaysdata.com;dbname=loquii_wcl' , 'loquii_english' , 'english');
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

$numberOfGroups = 20;
$numberOfStudent = 950;
$numberOfAdmin = 1;
$numberOfTeacher = 10;
$numberOfGroup = 60;
$numberOfStudentByGroup = 17;
$langue = array('English','Italiano', 'Duits', 'Español');
$etablisment = 'Lycee Simone Veil';


$group = array();
$level = array('2nd','1ere','Ter');
$langueA = array('AN','ES','IT','AL');
$langue = array('Anglais','Espagnol','Italien','Allemand');
for ($i=0;$i<$numberOfGroups;$i++)
{
    $posLangue = mt_rand(0,count($langue)-1);
    $posLevel = mt_rand(0,count($level)-1);
   $levelST = $level[$posLevel];
   $langueSt = $langueA[$posLangue];
   echo '<br>'.$levelST.$langueSt.$i;
    $studentGroup = $levelST.$langueSt.$i;
   array_push($group,$studentGroup);
    addGroup($studentGroup,$etablisment);
}
echo '<br>';
print_r($group);
echo "<br>";
$teachers = array();

for ($i =0;$i<$numberOfTeacher;$i++)
{
    $teacherLangue = $langue[mt_rand(0,count($langue)-1)];
    $teacherName = 'Teacher_'.$teacherLangue.'_'.$i;
    echo '<br>'.$teacherName;
}
$it = 0;

for ($i=0;$i<$numberOfGroup;$i++)
{
    $groupForClass = $group[mt_rand(0,count($group)-1)];
    echo '<br><br>'.$groupForClass.'<br><ul>';

    for ($i2=0;$i2<$numberOfStudentByGroup;$i2++)
    {
        $it++;
        $username = 'Student_'.$i.'_'.$i2;
        addStudent($username,$username,'Student',$etablisment);
        addGroupForStudent($username,$groupForClass,'Student',$etablisment);
        echo '<li>'.$username.'</li>';
    }
    echo '</ul><br>';
}

echo '<br>it : '.$it;

function addGroup($name, $etablishing)
{
    if($name == NULL)
    {
        return '<div class="alert alert-error">Vous devez remplir tout les champs.</div>';
    }
    else
    {
        global $bdd;

        $req = $bdd->prepare("INSERT INTO groups(name, etablishing) VALUE (:name, :etablishing)");
        $req->execute(array('name' => $name, 'etablishing' => $etablishing));

       // return '<div class="alert alert-success">Ce group a bien été ajouté.</div>';
    }
}
function addStudent($username, $password, $category, $etablishing)
{
    $passwordHach = sha1($password);

    global $bdd;

    $req = $bdd->prepare('INSERT INTO users(username, password, category, etablishing) VALUE (:username, :password, :category, :etablishing)');
    $req->execute(array('username' => $username, 'password' => $passwordHach, 'category' => $category, 'etablishing' => $etablishing));
}
function addGroupForStudent($username, $groupName, $category, $etablishing)
{
    global $bdd;

    $req = $bdd->prepare("INSERT INTO usergroup(username, groupName, category, etablishing) VALUE(:username, :groupName, :category, :etablishing)");
    $req->execute(array('username' => $username, 'groupName' => $groupName, 'category' => $category, 'etablishing' => $etablishing));
}