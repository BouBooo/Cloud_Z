
<div align="center">
  <a href="index.php?page=profil"><button class="btn btn-dark btn-lg mt-4">Return to the site</button></a>
</div>


<div align="center">
  <a href="index.php?page=actions"><button class="btn btn-dark btn-lg mt-4">Last actions</button></a>
</div>


<div class="container">

    <h1>Admin space</h1>
    <br>

    <div class="row">

        <form method="POST" action="" enctype="multipart/form-data">       
            <table style="margin-top:2%; margin-left:2%; width:125%" class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Rank</th>
                    <th>Files uploaded</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($data = $getUsers->fetch())
                {
                    // Count how many files each user had uploaded
                    
                    $getUserFiles = $db->prepare("SELECT * FROM files WHERE member_id = ?");
                    $getUserFiles->execute(array($data['id']));
                    $countFiles = $getUserFiles->rowCount();
                    echo'<tr>';
                    echo '<td align="left">';    
                    echo $data['name'];
                    echo '</td>';
                    echo '<td>';
                    echo ' <b>' . $data['email'] . '</b> ';
                    echo '</td>';
                    echo '<td>';
                    if($data['admin'] == 1)
                    {
                        echo "<p>Admin</p>";
                    }
                    else
                    {
                        echo "Member";
                    }
                    echo '</td>';
                    echo '<td>';
                    echo $countFiles;
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-danger" href="index.php?page=delete_user&id='.$data['id'].'"> Delete user  </a> &nbsp &nbsp';
                    echo  '<a class="btn btn-success" href="index.php?page=view_files&id='.$data['id'].'"> View files   </a> &nbsp &nbsp';
                    echo  '<a class="btn btn-primary" href="index.php?page=view&id='.$data['id'].'"> View   </a> <br>';
                    echo '</td>';
                    echo'</tr>';
                }
                ?>

            </table>
        </form>
    </div>
</div>