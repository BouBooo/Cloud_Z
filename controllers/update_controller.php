<?php

    $updateError = "";
    $updateSuccess = "";

    if(!empty($_SESSION['id']) && $_SESSION['id'] > 0)
    {
        $db = Database::connect();
        $requser = $db->prepare("SELECT * FROM membres WHERE id = ?");
        $requser->execute(array($_SESSION['id']));
        $user = $requser->fetch();
        $user_email = $user['email'];
        $user_name = $user['name'];
        $user_img = $user['img'];
        $user_desc = $user['description'];
        $_SESSION['img'] = $user_img;


    }
    else
    {
        header('Location: connexion.php');
    }
    


if(isset($_POST['update']))
{
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['desc']))
    {
        if($user_name != $_POST['name'] || $user_email != $_POST['email'] || $user_desc != $_POST['desc'])
        {
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $db = Database::connect();
                $reqmail = $db->prepare("SELECT * FROM membres WHERE email = ?");
                $reqmail->execute(array($_POST['email']));
                $mailexist = $reqmail->rowCount();
                if ($mailexist == 0  || $user_email == $_POST['email']) 
                {
                    $update = $db->prepare("UPDATE membres SET name = ?, email = ?, description = ? WHERE id = ?");
                    $update->execute(array($_POST['name'], $_POST['email'], $_POST['desc'], $_SESSION['id']));
                    $updateSuccess = "<div class='alert alert-success'>Profile edited with success</div>";
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['name'] = $_POST['name'];
                    $user_email = $_POST['email'];
                    $user_name = $_POST['name'];
                    $user_desc = $_POST['desc'];
                    $db = Database::disconnect();
                }
                else
                {
                    $updateError = "<div class='alert alert-danger'>This email already exists</div>"; 
                }
            }
            else
            {
                $updateError = "<div class='alert alert-danger'>Please use a valide email</div>"; 
            }
        }
        else if (isset($_FILES['img']) AND !empty($_FILES['img']['name']))   # Nouvelle photo de profil
        {
            $tailleMax = 2097152;
            $extensionsValides = array('jpg','jpeg','gif','png');
            if ($_FILES['img']['size' ] <= $tailleMax) 
            {
                $extensionUpload = strtolower(substr(strrchr($_FILES['img']['name'], '.'), 1));
                if(in_array($extensionUpload, $extensionsValides)) 
                {
                    $path = "membres/img/".$_SESSION['id'].".".$extensionUpload;
                    $resultat = move_uploaded_file($_FILES['img']['tmp_name'], $path);
                    if($resultat)
                    {
                        $updateavatar = $db->prepare('UPDATE membres SET img = ? WHERE id = ?');
                        $updateavatar->execute(array($_SESSION['id'].".".$extensionUpload, $_SESSION['id']));
                        $updateSuccess = "<div class='alert alert-success'>Avatar edited with success</div>";
                    }
                    else
                    {
                        $updateError = "<div class='alert alert-danger'>Erreur durant l'importation de la photo</div>";
                    }
                }
                else
                {
                    $updateError = "<div class='alert alert-danger'>Allowed formats <ul> <li> jpeg </li> <li> jpg </li> <li> png </li> <li> gif </li> </ul></div>";
                }
            }
            else
            {
                $updateError = "<div class='alert alert-danger'>Votre photo de profil ne doit pas dépasser 2Mo</div>";
            }
        }
        else
        {
            $updateError ="<div class='alert alert-danger'>No changes detected</div>";
        }
    }
    else
    {
        $updateError = "<div class='alert alert-danger'>You can't let an empty input</div>";
    }

}

// Remove current profile picture and set default one

if(isset($_POST['delete_picture']))
{
    $db = Database::connect();
    $delete_avatar = $db->prepare('UPDATE membres SET img = "default.png" WHERE id = ?');
    $delete_avatar->execute(array($_SESSION['id']));
    $updateSuccess = "<div class='alert alert-success'>Avatar removed with success</div>";
    
}
?>
