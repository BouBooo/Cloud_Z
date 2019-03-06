<div align="center">
  <a href="index.php?page=admin"><button class="btn btn-dark btn-lg mt-4"><span class="glyphicon glyphicon-chevron-left">Go forward</span></button></a>
</div>

<div class="container">
    <div class="row">

    

<?php
            // Show files for this user

            $getUserFiles = $db->prepare("SELECT * FROM files WHERE member_id = ? ORDER BY access");
            $getUserFiles->execute(array($user_infos['id']));
            $_SESSION['current_user'] = $user_infos['id'];
            $countFiles = $getUserFiles->rowCount();

            if($countFiles == 0)
            {
                echo ' <table style="margin-top:2%; width:27%; margin-left:35%;" class="table table-striped table-dark">';
                echo'<tr>';
                echo '<td>';
                echo 'No files found for ' . $email;
                echo '</td>';
                echo'</tr>';
                
            }
            else
            {
                echo ' <table style="margin-top:2%; margin-left:5%" class="table table-striped table-dark">';
                while($data = $getUserFiles->fetch())
                {
                    echo'<tr>';
                    echo '<td align="left">';    
                    echo $data['name'];
                    echo '</td>';
                    echo '<td>';
                    echo ' <b>' . $data['access'] . ' file</b>    ';
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-primary" href="files/'.$data['name'].'"> View</a> <br>';
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-primary" href="index.php?page=delete_file&id='.$data['id'].'"> Supprimer   </a> <br>';
                    echo '</td>';
                    echo'</tr>';
                }
            }
?>

    </div>
</div>

        