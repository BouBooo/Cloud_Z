<style>
        body  {
            background-color: #76B12E;

        }
</style>


<div class="container">
    <div align="center">
        <h1>Boite de reception</h1>

        <a class="btn btn-info" href="index.php?page=envoi">New message</a>

        <br>
        <br>
        <table class="table table-striped table-light">
        <thead>
                <tr>
                    <th>Status</th>
                    <th>Object</th>
                    <th>From</th>
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
                $id = $message['id'];

                if($message['status'] == 1)
                {
                    $message_status = '<img width="35" src="./assets/img/opened.png"/>';
                    $message_object = $message['object'];
                }
                else
                {
                    $message_status = '<img width="40" src="./assets/img/message.png"/>';
                    $message_object = '<b>'. $message['object'].'</b>';
                }
            ?>
            <tr>
                <td>
                    <?= $message_status ?>
                </td>
                <td>
                    <?= $message_object ?>
                </td>
                <td>
                    <?= $p_exp ?>
                </td>
                <td>
                <?php
                    echo '<a href="index.php?page=read&id='.$id.'" class="btn btn-success">Read</a>';
                    echo '&nbsp;';
                    echo '<a href="index.php?page=delete_message&id='.$id.'" class="btn btn-danger">Delete</a>';
                ?>
                </td>

            </tr>

            <?php
            }
            ?>
    </div>
</div>