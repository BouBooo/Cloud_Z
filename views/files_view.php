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
                $req_files = $db->prepare('SELECT * FROM files WHERE member_id = ? AND access = ?');
                $req_files->execute(array($_SESSION['id'], $_POST['access']));

                echo ' <table style="margin-top:2%; width:100%" class="table table-striped table-dark">';
                while($data = $req_files->fetch())
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
                    echo  '<a class="btn btn-primary" href="delete_file.php?id='.$data['id'].'"> Delete   </a> <br>';
                    echo '</td>';
                    echo'</tr>';
                }
                
                

            }
            

        ?>

        </table>
        </div>

<?php
    $db = Database::disconnect();
?>