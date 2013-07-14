<?php
function addUser($username, $password, $lv1, $lv2, $lv3, $category, $etablishing, $group)
{
    if(empty($username) || empty($password))
    {
        return '<div class="alert alert-error">Vous devez remplir tout les champs.</div>';
    }
    elseif(strlen($username) < 2)
    {
        return '<div class="alert alert-error">Ce pseudo est trop court.</div>';
    }
    elseif(strlen($password) < 4)
    {
        return '<div class="alert alert-error">Ce mot de passe est trop court.</div>';
    }
    else
    {
        $passwordHach = sha1($password);

        global $bdd;

        if($group == NULL)
        {
            $req = $bdd->prepare('INSERT INTO users(username, password, lv1, lv2, lv3, category, etablishing) VALUE (:username, :password, :lv1, :lv2, :lv3, :category, :etablishing)');
            $req->execute(array('username' => $username, 'password' => $passwordHach, 'lv1' => $lv1, 'lv2' => $lv2, 'lv3' => $lv3, 'category' => $category, 'etablishing' => $etablishing));
        }
        else
        {
            $req = $bdd->prepare('INSERT INTO users(username, password, lv1, lv2, lv3, category, etablishing) VALUE (:username, :password, :lv1, :lv2, :lv3, :category, :etablishing)');
            $req->execute(array('username' => $username, 'password' => $passwordHach, 'lv1' => $lv1, 'lv2' => $lv2, 'lv3' => $lv3, 'category' => $category, 'etablishing' => $etablishing));

			foreach ($group as $groupName)
			{
				addGroupForStudent($username, $groupName, $language, $category, $etablishing);
			}
			
        }  

        return '<div class="alert alert-success">This account has been added.</div>';
    }
}

function addStudent($username, $password, $category, $etablishing)
{
    $passwordHach = sha1($password);

    global $bdd;

	$req = $bdd->prepare('INSERT INTO users(username, password, category, etablishing) VALUE (:username, :password, :category, :etablishing)');
    $req->execute(array('username' => $username, 'password' => $passwordHach, 'category' => $category, 'etablishing' => $etablishing));
}

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

        return '<div class="alert alert-success">Ce group a bien été ajouté.</div>';
    }
}

function addEtablishing($etablishing)
{
    if($etablishing == NULL)
    {
        return '<div class="alert alert-error">Vous devez remplir tout les champs</div>';
    }
    else
    {
        global $bdd;

        $req = $bdd->prepare("INSERT INTO etablishing(name) VALUE (?)");
        $req->execute(array($etablishing));

        return '<div class="alert alert-success">Cet établissement a bien été ajouté.</div>';
    }
}

function getListEtablishings()
{
    global $bdd;
    
    $req = $bdd->prepare("SELECT * FROM etablishing ORDER BY name");
    $req->execute();

    $listEtablishings = $req->fetchAll();
    return $listEtablishings;
}

function getListUsers()
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM users WHERE username != "admin" AND category != "Student"');
    $req->execute();

    $listUsers = $req->fetchAll();
    return $listUsers;
}

function getListStudents($groupName)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM usergroup WHERE category = "Student" AND groupName = ?');
    $req->execute(array($groupName));

    $listStudents = $req->fetchAll();
    return $listStudents;
}
function getGroups($etablishing)
{
	global $bdd;
	$req = $bdd->prepare('SELECT name FROM groups WHERE etablishing = ?');
    $req->execute(array($etablishing));
	$rep = $req->fetchAll();
	$line = '';
	
	foreach ($rep as $group)
	{
		$line = $line.','.$group['name'];
		
	}
	
	return $line;
}

function getListGroups()
{
    global $bdd;

    $req = $bdd->prepare('SELECT name FROM groups WHERE etablishing = ? ORDER BY name');
    $req->execute(array($_SESSION['etablishing']));

    $listGroups = $req->fetchAll();
    return $listGroups;
}

function VerifyUser($username)
{
	global $bdd;
	
	$req = $bdd->prepare('SELECT COUNT(*) as exist FROM users WHERE username=?');
	$req->execute(array($username));
	$rep = $req->fetch();
		
	$exist = $rep['exist'];
	if ($exist == 0)
	{
		return true;
	}
	else{
		return false;
	}
}
function addGroupForStudent($username, $groupName, $category, $etablishing)
{
	global $bdd;

	$req = $bdd->prepare('INSERT INTO usergroup(username, groupName, category, etablishing) VALUE(:username, :groupName, :category, :etablishing)');
	$req->execute(array('username' => $username, 'groupName' => $groupName, 'category' => $category, 'etablishing' => $etablishing));
}
function deleteUser($user)
{
	global $bdd;

	$req = $bdd->prepare('DELETE FROM users WHERE id = ? OR username = ?');
	$req->execute(array($user,$user));

	$req = $bdd->prepare('DELETE FROM usergroup WHERE username = ?');
    $req->execute(array($user));
}
function editUser($tag,$value, $user)
{
// to use this function tou have to send the input to change like user.name for a db with table user and name for input in the table. second parrameter : $value is the new value to attribute. 
    global $bdd;

    $values= explode('.', $tag, 2);
//print_r($values);
    $tble= $values[0];
    $champ=$values[1];
    $query= 'UPDATE '.$tble.' SET '.$champ.'= ? WHERE username=?';
    $req=$bdd->prepare($query);
    $req->execute(array($value, $user));
//return $query;
}
function reinitPassword($user) {
    $cars = 'az0erty2ui3op4qs5df6gh7jk8lm9wxcvbn';
    $long = strlen($cars);

    $wpas = "";
    $taille = 6;

    for ($i = 0; $i < $taille; $i++)
    {
        $pos = mt_rand(0, $long-1);
        $wpas .= substr($cars,$pos, 1);
    }
    $newpasshach = sha1($wpas);
    editUser('users.password',$newpasshach,$user);
    return $wpas;

}