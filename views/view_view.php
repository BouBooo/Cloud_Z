<div align="center">
  <a href="index.php?page=admin"><button class="btn btn-dark btn-lg mt-4"><span class="glyphicon glyphicon-chevron-left">Go forward</span></button></a>
</div>

<br>
<h1 class="title-pen" align="center"> User <span><?= $name; ?></span></h1>

<div class="col-md">
  



  <form method="POST" action="" enctype="multipart/form-data">       
  <table style="margin-top:2%; margin-left:10%; width:80%" class="table table-bordered table-dark">

  <tr>
      <td>
          <label>Username : </label>
      </td>
      <td>
          <input class="form-control form-control-sm" disabled type="text" name="name" value="<?= $name; ?>"/>
      </tr>
  </tr>
  <tr>
      <td>
          <label for="email">Email : </label>
      </td>
      <td>
          <input class="form-control form-control-sm" disabled name="email" id="email" value="<?= $email; ?>">
      </td>
  </tr>
  <tr>
      <td>
          <label for="rank">Rank : </label>
      </td>
      <td>
          <input style="width:50%" class="form-control form-control-sm" disabled name="rank" id="rank" value="<?= $rank; ?>">
          <?php if($rank ==  "Member")
          {
            echo '<form action="" method="POST">';
            echo '<input type="submit" style="float:right" class="btn btn-primary" name="upgrade" value="Upgrade"></button>';
            echo '</form>';
          }
          ?>
      </td>
  </tr>
  </table>
  
  <div class="row">
  <div class="col-sm">
      
    </div>
    <div class="col-sm">

    </div>
</div>
</div>
  </form>


    </div>