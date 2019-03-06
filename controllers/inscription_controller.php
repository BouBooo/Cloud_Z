<?php

session_start();

$error_msg = "";


    if(isset($_POST['signin']))
    {
        if(!empty($_POST['name']) && !empty($_POST['password']) &&  !empty($_POST['password_confirm']) &&  !empty($_POST['email']) &&  !empty($_POST['email_confirm']))
        {
            if($_POST['password'] == $_POST['password_confirm'])
            {
                if($_POST['email'] == $_POST['email_confirm'])
                {
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                    {
                        $db = Database::connect();
                        $reqmail = $db->prepare("SELECT * FROM membres WHERE email = ?");
                        $reqmail->execute(array($_POST['email']));
                        $mailexist = $reqmail->rowCount();
                        if ($mailexist == 0) 
                        {
                            if(strlen($_POST['name']) <= 50)
                            {
                                if(strlen($_POST['password']) <= 80 || strlen($_POST['email']) <= 80)
                                {
                                    // Inscription success

                                    $name = $_POST['name'];
                                    $email = $_POST['email'];
                                    $email_confirm = $_POST['email_confirm'];
                                    $password = sha1($_POST['password']);
                                    $password_confirm = sha1($_POST['password_confirm']);
    
                                    $insert_member = $db->prepare("INSERT INTO membres(name, email, password, admin, img) VALUES (?,?,?,?,?)");
                                    $insert_member->execute(array($name, $email, $password, 0, "default.png"));
                                    Database::disconnect();
                                    $_SESSION['sign_success'] = "<div class='alert alert-success'>Registration successfully completed</div>";
                                    
                                    header('Location: index.php?page=connexion');
                                }
                                else
                                {
                                    $error_msg = "<div class='alert alert-danger'>Votre email / password ne doit pas dépasser 80 charactères</div>";
                                }
                            }
                            else
                            {
                                $error_msg = "<div class='alert alert-danger'>Votre nom ne doit pas dépasser 50 charactères</div>";
                            }
                        }
                        else
                        {
                            $error_msg = "<div class='alert alert-danger'>Email déjà utilisé</div>";
                        }
                    }
                    else
                    {
                        $error_msg = "<div class='alert alert-danger'>Email invalide</div>";
                    }
                }
                else
                {
                    $error_msg = "<div class='alert alert-danger'>Les emails doivent être identiques</div>";
                }
            }
            else
            {
                $error_msg = "<div class='alert alert-danger'>Les mots de passe doivent être identiques</div>";
            }

        }
        else
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $email_confirm = $_POST['email_confirm'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $error_msg = "<div class='alert alert-danger'>Merci de renseigner tous les champs</div>";
        }
    
    }
?>