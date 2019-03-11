<?php
session_start();

$message_error = "";
$message_success = "";

$db = Database::connect();
$getUsers = $db->prepare("SELECT email FROM membres WHERE NOT (email = ?)");
$getUsers->execute(array($_SESSION['email']));


if(!empty($_POST['send_message']))
{
    $destinataire = htmlspecialchars($_POST['destinataire']);
    $message = htmlspecialchars($_POST['message']);

    if(!empty($destinataire) || !empty($message))
    {
        $id_destinataire = $db->prepare("SELECT id FROM membres WHERE email = ?");
        $id_destinataire->execute(array($destinataire));
        $id_destinataire = $id_destinataire->fetch();
        $id_destinataire = $id_destinataire['id'];

        $insert = $db->prepare("INSERT INTO messages(id_expediteur, id_destinataire, message) VALUES(?,?,?)");
        $insert->execute(array($_SESSION['id'], $id_destinataire, $message));

        $message_success = "<span class='alert alert-success'>Your message has been send.</span>";
    }
    else 
    {
        $message_error = "<span align='center' class='alert alert-danger'>A message needs a receiver and a content.</span>";
    }
}

?>