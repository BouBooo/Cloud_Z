<style>
        @import url(https://fonts.googleapis.com/css?family=Raleway|Varela+Round|Coda);
        @import url(http://weloveiconfonts.com/api/?family=entypo);

        .title-pen {
        color: #333;
        font-family: "Coda", sans-serif;
        text-align: center;
        }

        body  {
            background-color: #76B12E;

        }

        .container  {
            background-color: white;
            width:60%;
            margin-top:1%;
            padding-bottom:2%;
            border-radius: 6px;
        }

</style>

<div class="container">
        <div align="center">
            <h1 class="title-pen">Lecture</h1> 

            <?php
            
            

            if($lecture)
            {
                $db = Database::connect();
                $p_exp = $db->prepare('SELECT email FROM membres WHERE id = ?');
                $p_exp->execute(array($message['id_expediteur']));
                $p_exp = $p_exp->fetch()['email'];
                

                ?>

                <h4>Participants : </h4>

                <div class="participants">
                                <ul>
                                    <li><b><?= $_SESSION['email'] ?></b></li>
                                    <li><b><?= $p_exp ?></b></li>
                                </ul>   
                </div>

                <div class="message">
                    <div class="date">
                        <?= $p_exp ?> - Posted at <?= $message['postedAt'] ?>
                    </div>
                    <?= $message['message'] ?>
                </div>
                
                <br>
                <?php

                $setStatus = $db->prepare('UPDATE messages SET status = 1 WHERE id = ?');
                $setStatus->execute(array($message['id']));

                $_SESSION['object'] = $message['object'];
                var_dump($_SESSION['object']);

            }

                ?>

            <?= $msg_error ?>


            <div class="buttons">
                <div class="element">
                    <a class="btn btn-info" href="index.php?page=messagerie">Back</a>
                </div>
                <div class="element">
                    <a class="btn btn-success" href="index.php?page=envoi&response=<?= $p_exp ?>">Reply</a>
                </div>
            </div>
        

        </div>
</div>