<?php
function addMessage($selectReceiver, $object, $body)
{
	global $bdd;

    foreach($selectReceiver as $receiver)
    {
        $req = $bdd->prepare("INSERT INTO message(sender, receiver, object, body) VALUE(:sender, :receiver, :object, :body)");
        $req->execute(array('sender' => $_SESSION['user'], 'receiver' => $receiver, 'object' => $object, 'body' => $body));
    }
}

function getLastMessage($id)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM message WHERE id = ? ORDER BY id DESC LIMIT 1');
    $req->execute(array($id));

    $lastMessage = $req->fetch();
    return $lastMessage;
}

function replyMessage($id, $receiver, $object, $body)
{
    $lastMessage = getLastMessage($id);

    $body .= '</br><blockquote>' . $lastMessage['body'] . '</blockquote>';

    global $bdd;

    $req = $bdd->prepare("INSERT INTO message(sender, receiver, object, body) VALUE(:sender, :receiver, :object, :body)");
    $req->execute(array('sender' => $_SESSION['user'], 'receiver' => $receiver, 'object' => $object, 'body' => $body));
}

function getMessage($id)
{
	global $bdd;

	$req = $bdd->prepare('SELECT * FROM message WHERE id = ?');
    $req->execute(array($id));

	$message = $req->fetch();
	return $message;
}

function getListTeachers()
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM users WHERE category = "Teacher" AND etablishing = :etablishing AND username != :username');
    $req->execute(array('etablishing' => $_SESSION['etablishing'], 'username' => $_SESSION['user']));

    $listTeachers = $req->fetchAll();
    return $listTeachers;
}

function getInfoUser($username)
{
    global $bdd;

    $req = $bdd->prepare('SELECT * FROM users WHERE username = ?');
    $req->execute(array($username));

    $user = $req->fetch();
    return $user;
}

function getReadMessage($id)
{
    global $bdd;

    $req = $bdd->prepare('UPDATE message SET readMessage = "1" WHERE id = ?');
    $req->execute(array($id));
}