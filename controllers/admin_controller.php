<?php
session_start();

    if(!empty($_SESSION['id']) && $_SESSION['id'] > 0)
    {
        if($_SESSION['admin'] == 1)
        {   
            // Fetch all users, except current user
            $db = Database::connect();
            $getUsers = $db->prepare("SELECT * FROM membres WHERE NOT (email = ?)");
            $getUsers->execute(array($_SESSION['email']));
        }
        else
        {
            header('Location: index.php?page=profil');
        }
    }
    else
    {
        header('Location: indx.php?page=connexion');
    }
?>
