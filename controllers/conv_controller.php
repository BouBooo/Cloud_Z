<?php
    session_start();
    $db = Database::connect();

if(!empty($_SESSION))
    {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=profil">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=update">Edit profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=files">My files</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=search">Search</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=upload">Upload</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=messagerie">Messagerie</a>
      </li>

      <?php    
            if($_SESSION['admin'] == 1)
            {   
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="index.php?page=admin">Admin space</a>';
              echo '</li>';
            }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=disconnect">Disconnect</a>
      </li>
    </ul>

  </div>
</nav>

<?php
    }
    else
    {
        header('Location: index.php?page=connexion');
    }
?>


<?php

    if(!empty($_POST['reply']))
    {
        $message = htmlspecialchars($_POST['message']);
        $destinataire_id = (int)$_GET['id'];
        $expediteur_id = $_SESSION['id'];

        $insert = $db->prepare("INSERT INTO messages (id_expediteur, id_destinataire, message, postedAt) VALUES (?,?,?,NOW())");
        $insert->execute(array($expediteur_id, $destinataire_id, $message));
        echo 'posted';
        
    }

    if(!empty($_POST['delete_msg']))
    {
        // Delete message

        $id = $_POST['id'];
        $delete = $db->prepare("DELETE FROM messages WHERE id = ? AND id_expediteur = ?");
        $delete->execute(array($id, $_SESSION['id']));
    }
?>
        <br>
        <h1 align="center">Messagerie</h1>
        <br>


















<div class="user-profile"> 
    <div class="message-body">
        <div class="message-left">
            <ul>
                <?php
                
                    // Show all user, except current connected user
                    $q = $db->prepare("SELECT mem.* FROM membres mem WHERE mem.id != ? ");
                    $q->execute(array($_SESSION['id']));
                    $convs = $q->fetchAll();
 
                    foreach($convs as $conv)
                    {
                        echo "<a href='index.php?page=conv&id=".$conv['id']."'><li><img width='50' src='membres/img/".$conv['img']."'> ".$conv['email']."</li></a>";
                    }
                ?>
            </ul>
        </div>
 
        <div class="message-right">
            <div class="display-message">
            <?php

                if(isset($_GET['id']))
                {
                    $destinataire = trim(htmlspecialchars($_GET['id']));
                    $q = $db->prepare("SELECT * FROM membres WHERE id= ? AND id != ? ");
                    $q->execute(array($destinataire, $_SESSION['id']));
                    $item = $q->fetch();
                    $countRow = $q->rowCount();


                    if($countRow == 1)
                    {

                        // My msg
                        $my_msg = $db->prepare("SELECT m.id, m.message, m.id_expediteur, m.id_destinataire, m.status, m.message, m.postedAt
                                                FROM messages m 
                                                WHERE (m.id_expediteur = ? AND m.id_destinataire = ?) 
                                                OR (m.id_expediteur = ? AND m.id_destinataire = ?)
                                                ");
                        $my_msg->execute(array($_SESSION['id'], $destinataire, $destinataire, $_SESSION['id']));
                        $rows = $my_msg->fetchAll();
                        $num = $my_msg->rowCount();
 
                        // Conversation
                        if($num > 0)
                        {
                        ?>

                        <p align="center"><b>Conversation with <?= $item['email']?></b></p>
                            <?php
                           
                            foreach($rows as $row)
                            {
                                

                                if($row['status'] == 0)
                                {
                                    $read =  "<img style='float:right' width='30' src='./assets/img/read.png'/>";

                                    // Update status
                                    $updateStatus = $db->prepare('UPDATE messages SET status = 1 WHERE id_expediteur = ? AND id_destinataire = ?');
                                    $updateStatus->execute(array($_SESSION['id'], $destinataire));
                                    
                                    
                                }
                                

                                //$updateStatus = $db->prepare('UPDATE messages SET')

                                if($row['id_destinataire'] == $destinataire)
                                {
                                    $message = $row['message'] . ' <br>';
                                    ?>
                                    <div class="clear"></div>
                                    <div class="from-me slam">
                                        <p>
                                            <div class="row">
                                                <?= $message ?>
                                                <!--<img style="width:30; height:30" src="./assets/img/delete.png"/>-->
                                            </div>
                                            <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <div class="container">                                                    
                                                <div class="element2">
                                                <!--input class="btn btn-danger" type="submit" name="delete_msg" value="Delete">-->
                                                
                                                </div>
                                            </div>             
                                        </p>
                                    </div>

                                    <?php
                                }
                                else
                                {
                                    $other_message = $row['message'] . ' <br>';
                                
                                    ?>
                                    <div class="clear"></div>
                                    <div class="from-them">
                                        <?= $other_message ?>
                                        <p></p>
                                    </div>
                                    
                                    <?php
                                }
                            }

                        }
                        else
                        { 
                            // No conversation yet
                            echo 'Send a message to start conversation';
                        }
                    }
                    else
                    {
                        header('Location: index.php?page=messagerie');
                    }
                }
    
    ?>     
            </div>
           
 
 

