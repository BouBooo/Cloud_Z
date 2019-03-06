<?php
  session_start();

    // FUNCTIONS 

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }


    // CONNECTION

    $error_msg = "";

    if(isset($_POST['login']))
    {
      $_SESSION['sign_succes'] = "";
      $password = checkInput(sha1($_POST['password']));
      $email = checkInput($_POST['email']);
      
      if(!empty($email) && !empty($password))
      {
        $db = Database::connect();
        $requser = $db->prepare("SELECT * FROM membres WHERE email = ? AND password = ?");
        $requser->execute(array($email, $password));
        $userexist = $requser->rowCount();
        if($userexist == 1)
        {
          $userinfo = $requser->fetch();
          $_SESSION['id'] = $userinfo['id'];
          $_SESSION['name'] = $userinfo['name'];
          $_SESSION['password'] = $userinfo['password'];
          $_SESSION['email'] = $userinfo['email'];
          $_SESSION['admin'] = $userinfo['admin'];
          $_SESSION['img'] = $userinfo['img'];
          Database::disconnect();
          
          header('Location:index.php?page=profil');
        }
        else
        {
          $error_msg = "<div class='alert alert-danger'>Mauvais identifiants</div>";
        }
      }
      else
      {
        $error_msg = "<div class='alert alert-danger'>Merci de renseigner tous les champs</div>";
      }
    }

?>
