<?php

if(isset($_SESSION['id']) && $_SESSION['id'] > 0)
{
    $db = Database::connect();
}



  // File Id
  if(!empty($_GET['id']))
  {
    $id = $_GET['id'];
  }



  if(!empty($_POST))
  {
    // Get infos about the deleted file
    $userInfo = $db->prepare("SELECT * FROM membres WHERE id = ?");
    $userInfo->execute(array($id));
    $userFetch = $userInfo->fetch();

    // Delete file
    $delete = $db->prepare("DELETE FROM membres WHERE id = ?");
    $delete->execute(array($id));
    $_SESSION['delete_msg'] = "<div class='alert alert-success'>User " . $userFetch['email'] . " deleted with success</div>";
    $_SESSION['delete_name'] = "User deletion";

    // Save informations about this deletion
    $saveAction = $db->prepare("INSERT INTO actions (name, about, date, admin_id) VALUES (?,?,now(),?)");
    $saveAction->execute(array($_SESSION['delete_name'], $_SESSION['delete_msg'], $_SESSION['id']));
    Database::disconnect();
    header('Location: index.php?page=admin');
  }
?>
