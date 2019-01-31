<?php

    if(!empty($_SESSION['id']) && $_SESSION['id'] > 0)
    {
        if($_SESSION['admin'] == 1)
        {
            // Get user infos

            $db = Database::connect();
            $getUser = $db->prepare("SELECT * FROM membres WHERE id = ?");
            $getUser->execute(array($_GET['id']));
            $user_infos = $getUser->fetch();

            $name = $user_infos['name'];
            $email = $user_infos['email'];
            $rank = $user_infos['admin'];

        }
        else
        {
            header('Location: index.php?page=profil');
        }
    }
    else
    {
        header('Location: index.php?page=connexion');
    }

?>