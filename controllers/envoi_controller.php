<?php
session_start();

$message_error = "";
$message_success = "";

$db = Database::connect();
$getUsers = $db->prepare("SELECT email FROM membres WHERE NOT (email = ?)");
$getUsers->execute(array($_SESSION['email']));

if(isset($_GET['response']) && !empty($_GET['response']))
{
    $response = htmlspecialchars($_GET['response']);
    var_dump($response);
}


if(!empty($_POST['send_message']))
{
    $destinataire = htmlspecialchars($_POST['destinataire']);
    $object = htmlspecialchars($_POST['object']);
    $message = htmlspecialchars($_POST['message']);

    if(!empty($destinataire) && !empty($message) && !empty($object))
    {
        $id_destinataire = $db->prepare("SELECT id FROM membres WHERE email = ?");
        $id_destinataire->execute(array($destinataire));
        $id_destinataire = $id_destinataire->fetch();
        $id_destinataire = $id_destinataire['id'];

        $insert = $db->prepare("INSERT INTO messages(id_expediteur, id_destinataire, postedAt, object,  message) VALUES(?,?, NOW(),?,?)");
        $insert->execute(array($_SESSION['id'], $id_destinataire, $object, $message));

        $message_success = "<span class='alert alert-success'>Your message has been send.</span>";
    }
    else 
    {
        $message_error = "<span align='center' class='alert alert-danger'>A message needs a receiver, an object and a content.</span>";
    }
}

?>