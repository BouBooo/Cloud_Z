<div class="container">
    <div align="center">
        <h1>Boite de reception</h1>

        <a class="btn btn-info" href="index.php?page=envoi">New message</a>

        <br>
        <br>


        <?= $no_msg ?>

        <?php 
            while($message = $msg->fetch())
            {
                $p_exp = $db->prepare('SELECT email FROM membres WHERE id = ?');
                $p_exp->execute(array($message['id_expediteur']));
                $p_exp = $p_exp->fetch();
                $p_exp = $p_exp['email'];
            ?>
            <p>New message from <?= $p_exp ?>  :  <?= $message['message'] ?> <br>
        
            <?php
            }
            ?>
    </div>
</div>