<?php
function connectionAdmin($username, $password, $etablishing)
{
    global $bdd;

    if(empty($username) || empty($password))
    {
        return '<div class="alert alert-error">Vous devez renseigner tout les champs.</div>';
    }
    else
    {
        $req = $bdd->prepare('SELECT COUNT(*) AS exist, username, category, language FROM users WHERE username = :username AND password = :password AND etablishing = :etablishing') or die(mysql_error());
        $req->execute(array('username' => $username,'password' => sha1($password), 'etablishing' => $etablishing));
        $data = $req->fetch();

        if($data['exist'] == 0)
        {
            return '<div class="alert alert-error">Votre pseudo ou mot de passe est incorrect.</div>';
        }
        else
        {
            $_SESSION['user'] = $username;
            $_SESSION['category'] = $data['category'];
            $_SESSION['etablishing'] = $etablishing;
            $_SESSION['language'] = $data['language'];

            setcookie('currentUser', $_SESSION['user'], time() + 365 * 24 * 3600, null, null, false, true);

            header('Location: admin');
        }

        $req->closeCursor();
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