<div class="container">
    <div align="center">
        <h1>Lecture</h1>
        <div  align="center">
            <a class="btn btn-info" href="index.php?page=messagerie">Back</a>
        </div>  

        <?php
        
         

        if($lecture)
        {
            $db = Database::connect();
            $p_exp = $db->prepare('SELECT email FROM membres WHERE id = ?');
            $p_exp->execute(array($message['id_expediteur']));
            $p_exp = $p_exp->fetch();
            $p_exp = $p_exp['email'];
            

            ?>
            From : <?= $p_exp ?> <br>

            <?= $message['message'] ?>
            <br>
            <?php

            $setStatus = $db->prepare('UPDATE messages SET status = 1 WHERE id = ?');
            $setStatus->execute(array($message['id']));

        }

            ?>

        <?= $msg_error ?>

        <a class="btn btn-success" href="index.php?page=envoi&response=<?= $p_exp ?>">Reply</a>

    </div>
</div>