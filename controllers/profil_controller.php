<?php
session_start();

    if(!empty($_SESSION['id']) && $_SESSION['id'] > 0)
    {
        $db = Database::connect();
        $requser = $db->prepare("SELECT * FROM membres WHERE id = ?");
        $requser->execute(array($_SESSION['id']));
        $user = $requser->fetch();
        $user_email = $user['email'];
        $user_name = $user['name'];
        $user_rank = $user['admin'];
        $user_desc = $user['description'];
        $user_img = $user['img'];

        if($user_rank == 1)
        {
            $user_rank = "<p>Admin</p>  <a class='btn btn-primary btn-sm' href='index.php?page=admin'>Admin interface</a>";
        }
        else
        {
            $user_rank = "Member";
        }
    }
    else
    {
        header('Location: index.php?page=connexion');
    }
    
?>
