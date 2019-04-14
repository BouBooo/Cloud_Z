<div class="container">
    <h2>Search files</h2>

    <form method="POST" action="">
    <h4> List public files</h4>
        <label for="limit">Fix limit :</label>
            <select id="limit" name="limit">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
                <option value="60">60</option>
            </select>
        <input type="submit" name="fix_limit" class="btn btn-info" value="Submit"> 
    </form>


    <form method="POST" action="">
    <h4>Find a private file </h4>
        <label for="private_key">Fill your private key :</label>
        <input type="text" name="private_key" placeholder="dfJ5cX1ke45q"/>

        <input type="submit" name="private_file" class="btn btn-info" value="Submit"> &nbsp; &nbsp;

        <?= $key_error; ?>
    </form>


    <!-- PUBLICS FILES -->
        <div class="column_1">
        <?php
        if($priv)
        {
            if($count > 0)
            {
                echo "<div align='center'><b>We found your private file !</b></div>";
            }
            else
            {
                echo "<div align='center'><b>That key doesn't match with any file..</b></div>";
            }

        }
        ?>
            <table style="margin-top:2%; margin-left:2%; width:100%" class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php
            if($all_files)
            {
                while($data = $req_files->fetch())
                {
                    echo'<tr>';
                    echo '<td align="left">';    
                    echo $data['name'];
                    echo '</td>';
                    echo '<td align="left">';    
                    echo $data['email'];
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-primary" href="files/'.$data['name'].'"> View</a> <br>';
                    echo '</td>';
                    echo'</tr>';
                }
            }
            else if($priv)
            {
                while($data = $req_files->fetch())
                {
                    echo'<tr>';
                    echo '<td align="left">';    
                    echo $data['name'];
                    echo '</td>';
                    echo '<td align="left">';    
                    echo $data['email'];
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-primary" href="files/'.$data['name'].'"> View</a> <br>';
                    echo '</td>';
                    echo'</tr>';
                }
            }
            else if($limit_fixed)
            {
                while($data = $req_files->fetch())
                {
                    echo'<tr>';
                    echo '<td align="left">';    
                    echo $data['name'];
                    echo '</td>';
                    echo '<td align="left">';    
                    echo $data['email'];
                    echo '</td>';
                    echo '<td>';
                    echo  '<a class="btn btn-primary" href="files/'.$data['name'].'"> View</a> <br>';
                    echo '</td>';
                    echo'</tr>';
                }
            }

            ?>
        
    
        
        
        
        
        </div>


        <!-- PRIVATE FILE WITH FILE KEY -->
        <div class="column_2">
        
        </div>
</div>