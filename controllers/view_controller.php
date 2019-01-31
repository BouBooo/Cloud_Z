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


            // Show files for this user

            $getUserFiles = $db->prepare("SELECT * FROM files WHERE member_id = ?");
            $getUserFiles->execute(array($user_infos['id']));


            if($rank == 1)
            {
                $rank = "Admin";
            }
            else
            {
                $rank = "Member";
            }      
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

if(!empty($_POST['upgrade']))
{
    $upUser = $db->prepare("UPDATE membres SET admin = 1 WHERE id = ?");
    $upUser->execute(array($user_infos['id']));
    $_SESSION['up_about'] = "<div class='alert alert-success'>User " . $user_infos['email'] . " became admin !</div>";
    $_SESSION['up_name'] = "User upgrade";


    // Save informations about this deletion
    $saveAction = $db->prepare("INSERT INTO actions (name, about, date, admin_id) VALUES (?,?,now(),?)");
    $saveAction->execute(array($_SESSION['up_name'], $_SESSION['up_about'], $_SESSION['id']));
}
?>
