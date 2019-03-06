<?php
session_start();

    if(!empty($_SESSION['id']) && $_SESSION['id'] > 0)
    {
        if($_SESSION['admin'] == 1)
        {
            $db = Database::connect();
            $getActions = $db->query("SELECT a.id, a.name, a.about, a.admin_id, a.date, m.email FROM actions a JOIN membres m ON m.id = a.admin_id ORDER BY a.id DESC");

        }
        else
        {
            header('Location: ../profil.php?id=' . $_SESSION['id']);
        }
    }
    else
    {
        header('Location: index.php?page=connexion');
    }

?>