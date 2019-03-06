<div align="center">
  <a href="index.php?page=admin"><button class="btn btn-dark btn-lg mt-4"><span class="glyphicon glyphicon-chevron-left">Go forward</span></button></a>
</div>

<br>
<br>

<div class="container">
    <div class="row">
    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Event id</th>
            <th scope="col">Name</th>
            <th scope="col">About this action</th>
            <th scope="col">Author</th>
            <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($data = $getActions->fetch())
                {
                    echo "<tr>";
                    echo "<th scope='row'> " . $data['id'] . "</th>";
                    echo "<td>" . $data['name'] . "</td>";
                    echo "<td>" . $data['about'] . "</td>";
                    echo "<td>" . $data['email'] . "</td>";
                    echo "<td>" . $data['date'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>
    </div>
</div>