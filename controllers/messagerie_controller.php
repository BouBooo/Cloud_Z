<?php
session_start();

$no_msg = "";


$db = Database::connect();
$msg = $db->prepare("SELECT * FROM messages WHERE id_destinataire = ? ORDER BY id DESC");
$msg->execute(array($_SESSION['id']));
$msg_nbr = $msg->rowCount();

if($msg_nbr == 0)
{
    $no_msg = "<span class='alert alert-warning'>You don't have any message :( <span>";
}