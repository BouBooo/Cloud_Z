<?php
session_start();

$no_msg = "";


$db = Database::connect();
$msg = $db->prepare("SELECT * FROM messages WHERE id_destinataire = ? ORDER BY id DESC");
$msg->execute(array($_SESSION['id']));
$msg_nbr = $msg->rowCount();

$msg_status = $db->prepare("SELECT * FROM messages WHERE id_destinataire = ? AND status = 0");
$msg_status->execute(array($_SESSION['id']));
$none_read = $msg_status->rowCount();

if($msg_nbr == 0)
{
    $no_msg = "<span class='alert alert-warning'>You don't have any message :( <span>";
}


if($none_read > 0)
{
    $no_msg = "Vous avez <b>".$none_read."</b> messages non lus<br>";
}