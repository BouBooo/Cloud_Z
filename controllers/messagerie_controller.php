<?php
session_start();

$message_error = "";

$db = Database::connect();
$getUsers = $db->prepare("SELECT email FROM membres WHERE NOT (email = ?)");
$getUsers->execute(array($_SESSION['email']));


if(!empty($_POST['send_message']))
{
    $destinataire = $_POST['destinataire'];
    $message = $_POST['message'];

    if(!empty($destinataire) && !empty($message))
    {
        // continue
    }
    else 
    {
        $message_error = "<span class='alert alert-danger'>A message needs a receiver and a content.</span>";
    }
}

?>