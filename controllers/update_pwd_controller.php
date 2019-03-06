<?php
session_start();
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
        $user_pwd = $user['password'];
    }
    else
    {
        header('Location: index.php?page=connexion');
    }


    

if(isset($_POST['update']))
{
    if(!empty($_POST['mdp']) && !empty($_POST['mdp2']) && !empty($_POST['mdp3']))
    {
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);
        $mdp3 = sha1($_POST['mdp3']);

        if($mdp2 == $mdp3)
        {
            if($mdp == $user_pwd)
            {
                if($mdp == $mdp2 && $mdp == $mdp3)
                {
                    $updateError = "<div class='alert alert-danger'>Your new password is your current password</div>"; 
                }
                else
                {
                    $statement = $db->prepare("UPDATE membres SET password = ? WHERE id = ?");
                    $statement->execute(array($mdp2, $_SESSION['id']));
                    $updateSuccess = "<div class='alert alert-success'>Profile edited with success</div>";
                    $db = Database::disconnect();
                }
            }
            else
            {
                $updateError = "<div class='alert alert-danger'>Your password does not match with your account</div>"; 
            }
        }
        else
        {
            $updateError ="<div class='alert alert-danger'>Please enter two similar passwords</div>";
        }
    }
    else
    {
        $updateError = "<div class='alert alert-danger'>Please inquire:
                         <ul>
                             <li> Your old password </ li>
                             <li> Your new password </ li>
                             <li> A confirmation of your new password </ li>
                </ul></div>";
    }

}

?>