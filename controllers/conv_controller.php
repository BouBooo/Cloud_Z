<?php
    session_start();
    $db = Database::connect();

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
        var_dump($id);
        $delete = $db->prepare("DELETE FROM messages WHERE id = ? AND id_expediteur = ?");
        $delete->execute(array($id, $_SESSION['id']));
    }
?>

        <a class="btn btn-light" href="index.php?page=messagerie">Back</a>
        <strong>Messages for <?php echo $_SESSION['email']; ?> </strong>

     
    <div class="message-body">
        <div class="message-left">
            <ul>
                <?php
                    // Show all user, except current connected user
                    $q = $db->prepare("SELECT * FROM membres WHERE id != ? ");
                    $q->execute(array($_SESSION['id']));
                    $rows = $q->fetchAll();
 
                    foreach($rows as $row)
                    {
                        echo "<a href='index.php?page=conv&id=".$row['id']."'><li><img width='50' src='membres/img/".$row['img']."'> ".$row['email']."</li></a>";
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
                            $reload = '<img src="./assets/img/reload.png"/>';
                        ?>

                        <p align="center"><b>Conversation with <?= $item['email']?></b></p>
                            <?php
                           
                            foreach($rows as $row)
                            {
                                if($row['id_destinataire'] == $destinataire)
                                {
                                    $message = $row['message'] . ' <br>';
                                    ?>
                                    <div class="clear"></div>
                                    <div class="from-me slam">
                                        <p>
                                            <?= $message ?>
                                            <form action="" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <div class="container">
                                                <div class="element1">
                                                    <p class="infos">Delivered at <?=$row['postedAt'] ?></p>
                                                </div>
                                                    
                                                <div class="element2">
                                                <input class="btn btn-danger" type="submit" name="delete_msg" value="Delete">
                                                <img width="25" src="./assets/img/delete.png"/>
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
 

