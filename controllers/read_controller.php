<?php
session_start();

$_SESSION['object'] = "";
$lecture = false;
$msg_error = "";


$db = Database::connect();
$msg = $db->prepare("SELECT m.id, m.id_expediteur, m.id_destinataire, m.message,m.object, m.postedAt, mem.email FROM messages m JOIN membres mem ON m.id_destinataire = mem.id WHERE m.id = ? AND m.id_destinataire = ?");
$msg->execute(array($_GET['id'], $_SESSION['id']));
$message = $msg->fetch();


if($message['id_destinataire'] == $_SESSION['id'])
{
    $lecture = true;
}
else
{
    $lecture = false;
    $msg_error = '<br><br><span class="alert alert-danger">Looks like this message does not exist or is not intended for you</span>';
}


// var_dump($_SESSION['id'], $message['id_destinataire'], $_GET['id']);
