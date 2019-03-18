<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $db = Database::connect();

    // Check message id
    if(!empty($_GET['id']))
    {
      $id = $_GET['id'];
    }
}


if(!empty($_POST))
{
    // Delete message
    $delete = $db->prepare("DELETE FROM messages WHERE id = ? AND id_destinataire = ?");
    $delete->execute(array($id, $_SESSION['id']));
    Database::disconnect();
    header('Location: index.php?page=messagerie');
}


