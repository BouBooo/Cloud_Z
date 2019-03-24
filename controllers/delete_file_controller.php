<?php
session_start();


if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $db = Database::connect();
}



  // File Id
  if(!empty($_GET['id']))
  {
    $id = $_GET['id'];
  }


  //delete de l'élément

  if(!empty($_POST))
  {
    $delete = $db->prepare("DELETE FROM files WHERE id = ?");
    $delete->execute(array($id));


    $_SESSION['file_about'] = "<div class='alert alert-success'>File (ID:".$id.") delete with success ! </div>";
    $_SESSION['file_name'] = "File deletion";



    // Save informations about this deletion
    $saveAction = $db->prepare("INSERT INTO actions (name, about, date, admin_id) VALUES (?,?,now(),?)");
    $saveAction->execute(array($_SESSION['file_name'], $_SESSION['file_about'], $_SESSION['id']));
    Database::disconnect();

    
    if($_SESSION['admin'] == 1)
    {
        header('Location: index.php?page=admin');
    }
    else
    {
        header('Location: index.php?page=files');
    }
    
  }
?>