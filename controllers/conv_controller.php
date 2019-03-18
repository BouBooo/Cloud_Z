<?php
    session_start();

    //shop not login  users from entering 
    if(isset($_SESSION['id'])){
        $db = Database::connect();
    }
    else
    {
        header("Location: index.php?page=connexion");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Messenger Like</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    
    <!-- Icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

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
                    var_dump($_GET['id']);  
                    $destinataire = trim(htmlspecialchars($_GET['id']));
                    $q = $db->prepare("SELECT id, email FROM membres WHERE id= ? AND id != ? ");
                    $q->execute(array($destinataire, $_SESSION['id']));
                    $item = $q->fetch();
                    $countRow = $q->rowCount();

                    if($countRow == 1)
                    {

                        // My msg
                        $my_msg = $db->prepare("SELECT m.id, m.message, m.id_expediteur, m.id_destinataire, m.status, m.message
                                                FROM messages m 
                                                WHERE (m.id_expediteur = ? AND m.id_destinataire = ?) 
                                                ");
                        $my_msg->execute(array($_SESSION['id'], $destinataire));
                        $rows = $my_msg->fetchAll();

                        // Other msg
                        $other_msg = $db->prepare("SELECT m.id, m.message, m.id_expediteur, m.id_destinataire, m.status, m.message
                                                FROM messages m 
                                                WHERE (m.id_destinataire = ? AND m.id_expediteur = ?) 
                                                ");
                        $other_msg->execute(array($_SESSION['id'], $destinataire));
                        $other = $other_msg->fetchAll();

                        $num = $my_msg->rowCount();
 
                        // Conversation
                        if($num > 0)
                        {
                            foreach($rows as $row)
                            {
                                $message = $row['message'] . ' (from ' . $_SESSION['email'] . ') <br>';
                                ?>
                                <div class="clear"></div>
                                <div class="from-me slam">
                                    <p>
                                        <?= $message ?>
                                        <p class="infos"></p>
                                    </p>
                                </div>

                                <?php
                                foreach($other as $user_msg)
                                {
                                    $other_message = $user_msg['message'] . ' (from ' . $item['email'] . ') <br>';
                                
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
                        die("Invalid $_GET ID.");
                    }
                }
                else 
                {
                    die("Click to start conversation");
                }


                if(isset($_POST['reply']))
                {
                    $message = htmlspecialchars($_POST['message']);
                    $conversation_id = htmlspecialchars($_POST['conversation_id']);
                    $user_form = htmlspecialchars($_POST['user_form']);
                    $user_to = htmlspecialchars($_POST['user_to']);
             
            
                    //insert into `messages`
                    $db = Database::connect();
                    $q = $db->prepare("INSERT INTO `messages` VALUES (?,?,?)");
                    $q->execute($user_form, $user_to, $message);

                    if($q)
                    {
                        echo "Posted";
                    }else{
                        echo "Error";
                    }
                }
            ?>
            </div>
 

            <!-- Send message -->
            <div class="send-message">
                <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Enter Your Message"></textarea>
                </div>
                <button class="btn btn-primary" id="reply">Reply</button> 
                <span id="error"></span>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script> 
</body>
</html>