<?php
function getInfoUser()
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM users WHERE username = ?');
    $req->execute(array($_SESSION['user']));

    $infoUser = $req->fetchAll();
    return $infoUser;
}

function changePassword($password1, $password2)
{
    if(empty($password1) || empty($password2))
    {
        return '<div class="alert alert-error">Vous devez renseigner tout les champs.</div>';
    }
    elseif(strlen($password1) < 4)
    {
        return '<div class="alert alert-error">Votre mot de passe est trop court.</div>';
    }
    elseif($password1 != $password2)
    {
        return '<div class="alert alert-error">Les mots de passe ne correspondent pas.</div>';
    }
    else
    {
        global $bdd;

        $passwordHach = sha1($password1);

        $req = $bdd->prepare('UPDATE users SET password = :password WHERE username = :username');
        $req->execute(array('password' => $passwordHach, 'username' => $_SESSION['user']));

        return '<div class="alert alert-success">Votre mot de passe a bien été changé.</div>';
    }
}