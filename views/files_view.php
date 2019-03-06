<style>
        @import url(https://fonts.googleapis.com/css?family=Raleway|Varela+Round|Coda);
        @import url(http://weloveiconfonts.com/api/?family=entypo);

        [class*="entypo-"]:before {
        font-family: 'entypo', sans-serif;
        }    

        .title-pen {
        color: #333;
        font-family: "Coda", sans-serif;
        text-align: center;
        }

</style>

    <div class="container">
        <br>
        <h1 class="title-pen">My files</h1>
        <br>
    <div class="row">

        <br>
        <br>


        <h2 class="title-pen">Fichiers de  : <?= $_SESSION['email']; ?></h2>
        
        <form method="POST" action="">
        <table style="margin-top:2%; width:100%">
        <tr>
            <td>
            <select class="form-control" name="access" id="access">
                    <option value="public">Public</option>
                    <option value="private">Private</option>
                </select>
            </td>
            <td>
                <input type="submit" name="see_files" value="See files" class="btn btn-primary btn-xl"/>
            </td>
        </tr>
    </table>
    </form>


    <?php 
            if(!empty($_POST['see_files']))
            {
                $req_files = $db->prepare('SELECT * FROM files WHERE member_id = ? AND access = ? ORDER BY id DESC');
                $req_files->execute(array($_SESSION['id'], $_POST['access']));
            }
            else
            {
                $req_files = $db->prepare('SELECT * FROM files WHERE member_id = ? ORDER BY id DESC');
                $req_files->execute(array($_SESSION['id']));
            }
?>
            <table style="margin-top:2%; margin-left:2%; width:125%" class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Accessibility</th>
                    <th>Key (private files only)</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
<?php
                while($data = $req_files->fetch())
                {
                    echo'<tr>';
                    echo '<td align="left">';    
                    echo $data['name'];
                    echo '</td>';
                    echo '<td>';
                    echo  $data['access'] . ' file';
                    echo '</td>';
                    echo '<td>';
                    echo $data['file_key'];
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-primary" href="files/'.$data['name'].'"> View</a> <br>';
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-primary" href="index.php?page=delete_file&id='.$data['id'].'"> Delete   </a> <br>';
                    echo '</td>';
                    echo'</tr>';
                }
                
                


            

        ?>

        </table>
        </div>

<?php
    $db = Database::disconnect();
?>