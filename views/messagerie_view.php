<div class="container">
    <div align="center">
        <h1>Boite de reception</h1>

        <a class="btn btn-info" href="index.php?page=envoi">New message</a>

        <br>
        <br>
        <table style="margin-top:2%; margin-left:10%; width:80%" class="table table-striped table-light p-5">
        <thead>
                <tr>
                    <th>Status</th>
                    <th>From</th>
                    <th>Object</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

        <?= $no_msg ?>

        <?php 
            while($message = $msg->fetch())
            {
                $p_exp = $db->prepare('SELECT email FROM membres WHERE id = ?');
                $p_exp->execute(array($message['id_expediteur']));
                $p_exp = $p_exp->fetch();
                $p_exp = $p_exp['email'];
            ?>
            <tr>
                <td>
                    
                </td>
                <td>
                    <?= $p_exp ?>
                </td>
                <td>
                    <?= $message['object'] ?>
                </td>
                <td>
                    <a href="index.php?page=read" class="btn btn-success">Read</a>
                    <a href="index.php?page=delete_message" class="btn btn-danger">Delete</a>
                </td>

            </tr>

            <?php
            }
            ?>
    </div>
</div>